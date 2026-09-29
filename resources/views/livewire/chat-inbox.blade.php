<div class="py-2 sm:py-6 bg-slate-50 min-h-[88vh]"
     x-data="{ 
         emojiPickerOpen: false,
         emojiTab: 'love',
         lightboxImage: null,
         showIcebreakers: true,
         isRecording: false,
         recordingTime: 0,
         recordingInterval: null,
         mediaRecorder: null,
         audioChunks: [],
         
         insertEmoji(emoji) {
             const input = this.$refs.messageInput;
             if (input) {
                 const start = input.selectionStart || 0;
                 const end = input.selectionEnd || 0;
                 const text = $wire.newMessage || '';
                 $wire.newMessage = text.substring(0, start) + emoji + text.substring(end);
                 this.$nextTick(() => {
                     input.focus();
                     input.setSelectionRange(start + emoji.length, start + emoji.length);
                 });
             } else {
                 $wire.newMessage = ($wire.newMessage || '') + emoji;
             }
         },

         handlePaste(e) {
             const items = (e.clipboardData || window.clipboardData)?.items;
             if (!items) return;
             for (let i = 0; i < items.length; i++) {
                 if (items[i].type.indexOf('image') !== -1) {
                     const blob = items[i].getAsFile();
                     if (blob) {
                         $wire.upload('attachment', blob);
                         e.preventDefault();
                         break;
                     }
                 }
             }
         },

         async startRecording() {
             try {
                 if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                     alert('Microphone recording is not supported in this browser.');
                     return;
                 }
                 const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                 this.audioChunks = [];
                 this.mediaRecorder = new MediaRecorder(stream);
                 
                 this.mediaRecorder.ondataavailable = (event) => {
                     if (event.data.size > 0) {
                         this.audioChunks.push(event.data);
                     }
                 };

                 this.mediaRecorder.onstop = async () => {
                     if (this.audioChunks.length > 0 && this.isRecording) {
                         const audioBlob = new Blob(this.audioChunks, { type: 'audio/webm' });
                         const reader = new FileReader();
                         reader.readAsDataURL(audioBlob);
                         reader.onloadend = () => {
                             const base64Data = reader.result;
                             $wire.sendVoiceNote(base64Data, this.recordingTime);
                         };
                     }
                     // Stop all mic audio tracks
                     stream.getTracks().forEach(track => track.stop());
                     this.isRecording = false;
                     clearInterval(this.recordingInterval);
                     this.recordingTime = 0;
                 };

                 this.mediaRecorder.start();
                 this.isRecording = true;
                 this.recordingTime = 0;
                 this.recordingInterval = setInterval(() => {
                     this.recordingTime++;
                 }, 1000);

             } catch (err) {
                 console.error('Microphone error:', err);
                 alert('Could not access microphone. Please grant permission.');
             }
         },

         stopAndSendRecording() {
             if (this.mediaRecorder && this.isRecording) {
                 this.mediaRecorder.stop();
             }
         },

         cancelRecording() {
             if (this.mediaRecorder && this.isRecording) {
                 this.audioChunks = [];
                 this.isRecording = false;
                 clearInterval(this.recordingInterval);
                 this.recordingTime = 0;
                 if (this.mediaRecorder.stream) {
                     this.mediaRecorder.stream.getTracks().forEach(track => track.stop());
                 }
             }
         },

         formatTime(seconds) {
             const m = Math.floor(seconds / 60).toString().padStart(2, '0');
             const s = (seconds % 60).toString().padStart(2, '0');
             return `${m}:${s}`;
         }
     }">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xs border border-slate-200/80 overflow-hidden grid grid-cols-1 md:grid-cols-12 min-h-[580px] sm:min-h-[720px] max-h-[85vh] h-[85vh]">
            
            <!-- Left Panel: Conversations List -->
            <div class="{{ $activeUser ? 'hidden md:flex' : 'flex' }} md:col-span-4 border-r border-slate-100 flex-col h-full bg-slate-50/50">
                <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between bg-white shrink-0">
                    <div>
                        <h2 class="font-black text-slate-900 text-base sm:text-lg">Conversations</h2>
                        <p class="text-[11px] text-slate-400">Real-time matrimonial chats & audio</p>
                    </div>
                    <span class="badge badge-primary bg-rose-600 border-none text-white text-xs font-bold">{{ $chatUsers->count() }}</span>
                </div>

                <!-- Chat Users List with Real-Time Polling -->
                <div wire:poll.4s class="flex-1 overflow-y-auto divide-y divide-slate-100 no-scrollbar">
                    @forelse($chatUsers as $u)
                        <div wire:click="selectUser({{ $u->id }})" class="p-3.5 sm:p-4 flex items-center gap-3.5 cursor-pointer hover:bg-white transition tap-active {{ $selectedUserId == $u->id ? 'bg-white shadow-xs border-l-4 border-rose-600' : '' }}">
                            <div class="relative shrink-0">
                                <img src="{{ $u->avatar_url }}" alt="{{ $u->name }}" class="w-12 h-12 rounded-2xl object-cover">
                                @if($u->isOnline())
                                    <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-emerald-500 rounded-full ring-2 ring-white shadow-xs" title="Online Now"></span>
                                @else
                                    <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-slate-400 rounded-full ring-2 ring-white shadow-xs" title="Offline"></span>
                                @endif
                                @if($u->unread_count > 0)
                                    <span class="absolute -bottom-1 -right-1 bg-rose-600 text-white font-black text-[9px] w-5 h-5 rounded-full flex items-center justify-center ring-2 ring-white">
                                        {{ $u->unread_count }}
                                    </span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-xs font-black text-slate-900 truncate">{{ $u->name }}</h4>
                                    @if($u->last_message)
                                        <span class="text-[10px] text-slate-400 shrink-0">{{ $u->last_message->created_at->format('H:i') }}</span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-500 truncate mt-0.5 {{ $u->unread_count > 0 ? 'font-bold text-slate-900' : '' }}">
                                    {{ $u->last_message?->message ?? 'Click to start chatting...' }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 sm:p-12 text-center text-slate-400 text-xs">
                            <i class="fa-regular fa-comments text-4xl mb-3 block text-slate-300"></i>
                            No active conversations yet. Explore matches and send a connection request!
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right Panel: Active Chat Stream -->
            <div class="{{ $activeUser ? 'flex' : 'hidden md:flex' }} md:col-span-8 flex-col h-full bg-white relative">
                @if($activeUser)
                    <!-- Active Chat Header -->
                    <div class="p-3 sm:p-4 sm:px-6 border-b border-slate-100 flex items-center justify-between bg-white z-10 shrink-0">
                        <div class="flex items-center gap-2.5 sm:gap-3.5">
                            <!-- Mobile Back to List Button -->
                            <button wire:click="$set('selectedUserId', null)" class="btn btn-ghost btn-circle btn-sm md:hidden text-slate-600 tap-active" aria-label="Back to conversations">
                                <i class="fa-solid fa-chevron-left text-base"></i>
                            </button>

                            <div class="relative shrink-0">
                                <img src="{{ $activeUser->avatar_url }}" alt="{{ $activeUser->name }}" class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl object-cover shrink-0">
                                @if($activeUser->isOnline())
                                    <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-emerald-500 rounded-full ring-2 ring-white shadow-xs" title="Online Now"></span>
                                @else
                                    <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-slate-400 rounded-full ring-2 ring-white shadow-xs" title="Offline"></span>
                                @endif
                            </div>
                            <div class="truncate">
                                <a href="{{ route('profile.show', $activeUser->id) }}" class="font-black text-slate-900 text-xs sm:text-sm hover:text-rose-600 transition flex items-center gap-1.5 truncate">
                                    <span class="truncate">{{ $activeUser->name }}</span>
                                    @if($activeUser->is_verified)
                                        <i class="fa-solid fa-circle-check text-emerald-500 text-xs shrink-0" title="Verified Member"></i>
                                    @endif
                                </a>
                                <p class="text-[10px] truncate flex items-center gap-1.5">
                                    @if($activeUser->isOnline())
                                        <span class="text-emerald-600 font-bold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active now</span>
                                    @else
                                        <span class="text-slate-400 flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> {{ $activeUser->online_status }}</span>
                                    @endif
                                    <span class="text-slate-300">&bull;</span>
                                    <span class="text-slate-400">{{ $activeUser->profile?->living_city ?? 'Kathmandu' }} &bull; {{ $activeUser->profile?->caste?->name ?? 'Nepali' }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-1.5 sm:gap-2">
                            <!-- 1-on-1 Video Date Button -->
                            <button wire:click="sendVideoInvite" class="btn btn-sm bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white rounded-xl text-xs font-bold border-none shadow-md shadow-rose-100 flex items-center gap-1.5 tap-active px-3 sm:px-4">
                                <i class="fa-solid fa-video text-xs"></i> <span class="hidden sm:inline">Video Date</span>
                            </button>
                            <a href="{{ route('profile.show', $activeUser->id) }}" class="btn btn-sm btn-ghost text-slate-500 rounded-xl text-xs px-2.5 tap-active" title="View Profile">
                                <i class="fa-solid fa-user"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Messages Stream with Auto-Scroll & Real-Time Polling -->
                    <div wire:poll.2s 
                         x-data="{ scrollToBottom() { $el.scrollTop = $el.scrollHeight } }"
                         x-init="scrollToBottom()"
                         x-effect="$nextTick(() => scrollToBottom())"
                         @paste="handlePaste($event)"
                         class="flex-1 p-4 sm:p-6 overflow-y-auto space-y-3.5 bg-slate-50/50" 
                         id="chat-messages-container">
                        
                        @if(session('error'))
                            <div class="alert alert-error shadow-sm rounded-2xl text-xs text-white">
                                <span>{{ session('error') }}</span>
                            </div>
                        @endif

                        @forelse($messages as $msg)
                            @php $isMe = $msg->sender_id === auth()->id(); @endphp
                            <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}">
                                <div class="max-w-[85%] sm:max-w-md p-3 sm:p-3.5 rounded-2xl text-xs leading-relaxed {{ $isMe ? 'bg-gradient-to-r from-rose-600 to-pink-600 text-white rounded-br-xs shadow-md shadow-rose-100' : 'bg-white text-slate-800 rounded-bl-xs border border-slate-200/80 shadow-xs' }}">
                                    
                                    <!-- Video Call Invite Card -->
                                    @if($msg->type === 'call_invite')
                                        <div class="p-2.5 rounded-xl {{ $isMe ? 'bg-white/20' : 'bg-rose-50' }} mb-2">
                                            <div class="flex items-center gap-2 mb-1.5 font-bold {{ $isMe ? 'text-amber-200' : 'text-rose-700' }}">
                                                <i class="fa-solid fa-video"></i> Virtual Video Date Room
                                            </div>
                                            <p class="text-[11px] mb-2 {{ $isMe ? 'text-white/90' : 'text-slate-600' }}">{{ $msg->message }}</p>
                                            @php
                                                preg_match('/(http[s]?:\/\/[^\s]+)/', $msg->message, $matches);
                                                $roomUrl = $matches[0] ?? null;
                                            @endphp
                                            @if($roomUrl)
                                                <a href="{{ $roomUrl }}" class="btn btn-xs {{ $isMe ? 'bg-white text-rose-600 hover:bg-slate-100' : 'bg-rose-600 text-white hover:bg-rose-700' }} border-none font-black rounded-lg inline-flex items-center gap-1.5">
                                                    <i class="fa-solid fa-camera-web"></i> Join Video Date Now
                                                </a>
                                            @endif
                                        </div>
                                    @endif

                                    <!-- Audio Voice Note Player -->
                                    @if($msg->type === 'audio' || ($msg->attachment_path && (str_ends_with($msg->attachment_path, '.webm') || str_ends_with($msg->attachment_path, '.mp3') || str_ends_with($msg->attachment_path, '.wav') || str_ends_with($msg->attachment_path, '.m4a') || str_ends_with($msg->attachment_path, '.ogg'))))
                                        <div class="p-2.5 rounded-xl {{ $isMe ? 'bg-white/20' : 'bg-slate-100' }} flex flex-col gap-2 min-w-[200px] sm:min-w-[240px]">
                                            <div class="flex items-center justify-between gap-2">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-8 h-8 rounded-full {{ $isMe ? 'bg-white text-rose-600' : 'bg-rose-600 text-white' }} flex items-center justify-center font-bold text-xs shadow-xs">
                                                        <i class="fa-solid fa-microphone"></i>
                                                    </div>
                                                    <span class="font-bold text-xs {{ $isMe ? 'text-white' : 'text-slate-800' }}">Voice Note</span>
                                                </div>
                                                @if($msg->audio_duration)
                                                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-full {{ $isMe ? 'bg-white/30 text-white' : 'bg-slate-200 text-slate-700' }}">
                                                        {{ gmdate('i:s', $msg->audio_duration) }}
                                                    </span>
                                                @endif
                                            </div>
                                            <audio controls class="w-full h-8 rounded-lg outline-none" style="filter: {{ $isMe ? 'brightness(1.1) invert(0.1)' : 'none' }}">
                                                <source src="{{ $msg->attachment_url }}" type="audio/webm">
                                                <source src="{{ $msg->attachment_url }}" type="audio/mp3">
                                                Your browser does not support audio playback.
                                            </audio>
                                        </div>
                                    @endif

                                    <!-- Attachment / Screenshot Display -->
                                    @if($msg->attachment_path && $msg->type !== 'audio' && !str_ends_with($msg->attachment_path, '.webm') && !str_ends_with($msg->attachment_path, '.mp3'))
                                        @if($msg->is_image)
                                            <div class="mb-2 overflow-hidden rounded-xl bg-black/10 cursor-pointer relative group/img max-w-sm">
                                                <img src="{{ $msg->attachment_url }}" alt="Screenshot / Image" @click="lightboxImage = '{{ $msg->attachment_url }}'" class="max-h-60 sm:max-h-72 w-auto rounded-xl object-contain hover:opacity-95 transition">
                                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover/img:opacity-100 transition flex items-center justify-center gap-2 pointer-events-none">
                                                    <span class="bg-black/60 text-white text-[10px] font-bold px-2.5 py-1 rounded-lg backdrop-blur flex items-center gap-1">
                                                        <i class="fa-solid fa-magnifying-glass-plus"></i> View Fullscreen
                                                    </span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="mb-2 p-2.5 rounded-xl {{ $isMe ? 'bg-white/20' : 'bg-slate-100' }} flex items-center justify-between gap-3">
                                                <div class="flex items-center gap-2.5 min-w-0">
                                                    <div class="w-8 h-8 rounded-lg {{ $isMe ? 'bg-white/30 text-white' : 'bg-rose-100 text-rose-600' }} flex items-center justify-center shrink-0">
                                                        <i class="fa-solid fa-file-lines text-sm"></i>
                                                    </div>
                                                    <div class="truncate">
                                                        <p class="font-bold text-xs truncate">{{ $msg->attachment_name ?? 'Attachment file' }}</p>
                                                        @if($msg->formatted_size)
                                                            <span class="text-[10px] opacity-80">{{ $msg->formatted_size }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <a href="{{ $msg->attachment_url }}" download target="_blank" class="btn btn-xs btn-circle {{ $isMe ? 'bg-white text-rose-600' : 'bg-rose-600 text-white' }} border-none shadow-xs shrink-0" title="Download file">
                                                    <i class="fa-solid fa-arrow-down-to-line"></i>
                                                </a>
                                            </div>
                                        @endif
                                    @endif

                                    <!-- Message Text Body -->
                                    @if($msg->message && !($msg->attachment_path && in_array($msg->message, ['Sent a photo / screenshot', 'Photo / Screenshot', 'Sent an audio voice message'])) && $msg->type !== 'call_invite' && !str_starts_with($msg->message, '🎤 Voice Note'))
                                        <p class="break-words {{ $msg->attachment_path ? 'mt-1.5 pt-1.5 border-t ' . ($isMe ? 'border-white/20' : 'border-slate-100') : '' }}">{{ $msg->message }}</p>
                                    @endif
                                </div>
                                <div class="flex items-center gap-1 mt-1 text-[10px] text-slate-400 px-1">
                                    <span>{{ $msg->created_at->format('h:i A') }}</span>
                                    @if($isMe)
                                        <i class="fa-solid {{ $msg->is_read ? 'fa-check-double text-rose-600' : 'fa-check' }}"></i>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="p-8 sm:p-12 text-center text-slate-400 text-xs">
                                <i class="fa-regular fa-hand text-3xl mb-2 block text-rose-400"></i>
                                Say Namaste to {{ $activeUser->name }} to break the ice!
                            </div>
                        @endforelse
                    </div>

                    <!-- Icebreaker Chips Bar -->
                    <div class="px-3 sm:px-4 py-2 bg-slate-100/70 border-t border-slate-200/60 overflow-x-auto no-scrollbar flex items-center gap-2">
                        <span class="text-[10px] font-black uppercase text-slate-400 tracking-wider shrink-0 flex items-center gap-1">
                            <i class="fa-solid fa-wand-magic-sparkles text-rose-500"></i> Icebreakers:
                        </span>
                        @foreach($icebreakers as $ice)
                            <button type="button" 
                                    wire:click="applyIcebreaker('{{ addslashes($ice) }}')"
                                    class="text-[11px] font-medium px-3 py-1 bg-white hover:bg-rose-50 text-slate-700 hover:text-rose-600 border border-slate-200 hover:border-rose-300 rounded-full shrink-0 transition shadow-xs tap-active">
                                {{ $ice }}
                            </button>
                        @endforeach
                    </div>

                    <!-- Voice Recording Live Active Bar -->
                    <div x-show="isRecording" 
                         x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 translate-y-2" 
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="px-4 py-3 bg-rose-500 text-white flex items-center justify-between gap-3 shadow-inner"
                         style="display: none;">
                        <div class="flex items-center gap-3">
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-200 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
                            </span>
                            <span class="text-xs font-black tracking-wide">Recording Voice Note...</span>
                            <span class="font-mono text-xs bg-rose-700/60 px-2 py-0.5 rounded-md font-bold" x-text="formatTime(recordingTime)">00:00</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="button" @click="cancelRecording()" class="btn btn-xs bg-rose-700 hover:bg-rose-800 text-white border-none rounded-lg text-xs font-bold tap-active">
                                <i class="fa-solid fa-trash mr-1"></i> Cancel
                            </button>
                            <button type="button" @click="stopAndSendRecording()" class="btn btn-xs bg-white hover:bg-slate-100 text-rose-600 border-none rounded-lg text-xs font-black shadow-md tap-active">
                                <i class="fa-solid fa-paper-plane mr-1"></i> Send Voice
                            </button>
                        </div>
                    </div>

                    <!-- Attachment Uploading State Banner -->
                    <div wire:loading wire:target="attachment" class="px-4 py-2 bg-rose-50 border-t border-rose-100 text-rose-700 text-xs font-bold flex items-center justify-between">
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-spinner fa-spin text-rose-600"></i>
                            Processing photo / screenshot upload...
                        </span>
                        <span class="text-[10px] text-rose-500 font-semibold">Please wait</span>
                    </div>

                    <!-- Attachment Selected Preview Bar -->
                    @if($attachment)
                        <div class="px-4 py-2.5 bg-slate-50 border-t border-slate-200/80 flex items-center justify-between gap-3 animate-fadeIn">
                            <div class="flex items-center gap-3 min-w-0">
                                @if(str_starts_with($attachment->getMimeType() ?? '', 'image/'))
                                    <div class="relative w-12 h-12 rounded-xl overflow-hidden bg-slate-200 shrink-0 border border-slate-300 shadow-xs">
                                        <img src="{{ $attachment->temporaryUrl() }}" alt="Attachment Preview" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-rose-50 border border-rose-200 text-rose-600 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-paperclip text-lg"></i>
                                    </div>
                                @endif
                                <div class="truncate">
                                    <p class="text-xs font-extrabold text-slate-800 truncate">{{ $attachment->getClientOriginalName() }}</p>
                                    <p class="text-[10px] text-slate-500 flex items-center gap-1.5 mt-0.5">
                                        <span>{{ number_format($attachment->getSize() / 1024, 0) }} KB</span>
                                        <span>&bull;</span>
                                        <span class="text-emerald-600 font-bold flex items-center gap-1">
                                            <i class="fa-solid fa-circle-check text-[9px]"></i> Ready to send
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <button type="button" wire:click="removeAttachment" class="btn btn-circle btn-ghost btn-xs text-slate-400 hover:text-rose-600 hover:bg-rose-50 tap-active" title="Cancel Attachment">
                                <i class="fa-solid fa-xmark text-sm"></i>
                            </button>
                        </div>
                    @endif

                    <!-- Floating Emoji Palette Dropdown -->
                    <div x-show="emojiPickerOpen" 
                         x-transition:enter="transition ease-out duration-200 transform" 
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95" 
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
                         x-transition:leave="transition ease-in duration-150 transform" 
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100" 
                         x-transition:leave-end="opacity-0 translate-y-2 scale-95" 
                         @click.outside="emojiPickerOpen = false"
                         class="absolute bottom-16 left-3 sm:left-4 z-30 bg-white rounded-2xl shadow-2xl border border-slate-200 p-3 w-72 sm:w-80"
                         style="display: none;">
                        
                        <!-- Category Tabs -->
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2 mb-2">
                            <div class="flex items-center gap-1 text-xs">
                                <button type="button" @click="emojiTab = 'love'" class="px-2.5 py-1 rounded-lg font-bold transition text-xs" :class="emojiTab === 'love' ? 'bg-rose-50 text-rose-600' : 'text-slate-500 hover:bg-slate-50'">
                                    💖 Love
                                </button>
                                <button type="button" @click="emojiTab = 'smile'" class="px-2.5 py-1 rounded-lg font-bold transition text-xs" :class="emojiTab === 'smile' ? 'bg-rose-50 text-rose-600' : 'text-slate-500 hover:bg-slate-50'">
                                    😊 Smiles
                                </button>
                                <button type="button" @click="emojiTab = 'nepali'" class="px-2.5 py-1 rounded-lg font-bold transition text-xs" :class="emojiTab === 'nepali' ? 'bg-rose-50 text-rose-600' : 'text-slate-500 hover:bg-slate-50'">
                                    🙏 Nepali
                                </button>
                            </div>
                            <button type="button" @click="emojiPickerOpen = false" class="text-slate-400 hover:text-slate-600 text-xs p-1">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>

                        <!-- Emojis Grid -->
                        <div class="max-h-48 overflow-y-auto no-scrollbar">
                            <!-- Tab: Love & Matrimonial -->
                            <div x-show="emojiTab === 'love'" class="grid grid-cols-6 gap-1 text-xl sm:text-2xl text-center">
                                @foreach(['❤️', '💖', '💍', '🌹', '🥰', '😍', '😘', '💕', '👰', '🤵', '💑', '💌', '✨', '💐', '🍫', '🍰', '💘', '💓'] as $em)
                                    <button type="button" @click="insertEmoji('{{ $em }}')" class="p-1.5 hover:bg-rose-50 rounded-xl transition transform hover:scale-125 tap-active" title="{{ $em }}">
                                        {{ $em }}
                                    </button>
                                @endforeach
                            </div>

                            <!-- Tab: Smiles & Reactions -->
                            <div x-show="emojiTab === 'smile'" class="grid grid-cols-6 gap-1 text-xl sm:text-2xl text-center" style="display: none;">
                                @foreach(['😊', '😄', '😁', '😂', '🤣', '😇', '😉', '🤩', '😎', '🤗', '🥺', '🥳', '😜', '😋', '😌', '🤫', '🤔', '🙌'] as $em)
                                    <button type="button" @click="insertEmoji('{{ $em }}')" class="p-1.5 hover:bg-rose-50 rounded-xl transition transform hover:scale-125 tap-active" title="{{ $em }}">
                                        {{ $em }}
                                    </button>
                                @endforeach
                            </div>

                            <!-- Tab: Nepali Culture & Gestures -->
                            <div x-show="emojiTab === 'nepali'" class="grid grid-cols-6 gap-1 text-xl sm:text-2xl text-center" style="display: none;">
                                @foreach(['🙏', '🪔', '🌺', '🕉️', '🤝', '👍', '👏', '✌️', '🤞', '🔥', '🌟', '🎈', '☕', '🎂', '🎉', '💯', '🌈', '🌻'] as $em)
                                    <button type="button" @click="insertEmoji('{{ $em }}')" class="p-1.5 hover:bg-rose-50 rounded-xl transition transform hover:scale-125 tap-active" title="{{ $em }}">
                                        {{ $em }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-2 pt-2 border-t border-slate-100 flex items-center justify-between text-[10px] text-slate-400">
                            <span>Tip: Paste screenshot with <kbd class="px-1 py-0.5 bg-slate-100 rounded text-[9px] font-mono">Ctrl+V</kbd></span>
                        </div>
                    </div>

                    <!-- Message Input Bar -->
                    <div class="p-2.5 sm:p-3.5 bg-white border-t border-slate-100 shrink-0">
                        <form wire:submit="sendMessage" class="flex items-center gap-1.5 sm:gap-2">
                            
                            <!-- Emoji Palette Trigger Button -->
                            <button type="button" 
                                    @click="emojiPickerOpen = !emojiPickerOpen" 
                                    class="btn btn-circle btn-ghost btn-sm text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition tap-active shrink-0" 
                                    title="Choose Emoji">
                                <i class="fa-regular fa-face-smile text-lg"></i>
                            </button>

                            <!-- Hidden Native File Upload Input -->
                            <input type="file" 
                                   x-ref="fileInput" 
                                   wire:model="attachment" 
                                   accept="image/*,.pdf,.doc,.docx" 
                                   class="hidden">

                            <!-- File / Screenshot Attachment Trigger Button -->
                            <button type="button" 
                                    @click="$refs.fileInput.click()" 
                                    class="btn btn-circle btn-ghost btn-sm text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition tap-active shrink-0" 
                                    title="Attach Photo, Screenshot, or Document (or paste screenshot Ctrl+V)">
                                <i class="fa-solid fa-paperclip text-base"></i>
                            </button>

                            <!-- Voice Note Recorder Mic Trigger Button -->
                            <button type="button" 
                                    x-show="!isRecording"
                                    @click="startRecording()" 
                                    class="btn btn-circle btn-ghost btn-sm text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition tap-active shrink-0" 
                                    title="Record Audio Voice Note">
                                <i class="fa-solid fa-microphone text-base"></i>
                            </button>

                            <!-- Text Message Input Field -->
                            <div class="flex-1 relative">
                                <input type="text" 
                                       x-ref="messageInput"
                                       wire:model="newMessage" 
                                       @paste="handlePaste($event)"
                                       placeholder="Type a message, record voice, or paste screenshot (Ctrl+V)..." 
                                       class="input input-bordered w-full rounded-2xl text-xs sm:text-sm focus:border-rose-500 focus:outline-none bg-slate-50 sm:bg-white pr-3">
                            </div>

                            <!-- Send Message Button -->
                            <button type="submit" 
                                    wire:loading.attr="disabled"
                                    class="btn btn-primary rounded-2xl text-xs font-bold bg-rose-600 hover:bg-rose-700 border-none text-white px-3.5 sm:px-5 shadow-md shadow-rose-200 tap-active shrink-0 flex items-center gap-1.5">
                                <span wire:loading.remove wire:target="sendMessage">
                                    <i class="fa-solid fa-paper-plane text-xs"></i>
                                </span>
                                <span wire:loading wire:target="sendMessage">
                                    <i class="fa-solid fa-spinner fa-spin text-xs"></i>
                                </span>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex-1 flex items-center justify-center p-8 text-center text-slate-400 text-xs">
                        <div>
                            <i class="fa-regular fa-comments text-5xl mb-3 block text-slate-200"></i>
                            Select a match from the conversation list to view messages.
                        </div>
                    </div>
                @endif
            </div>

        </div>

    </div>

    <!-- Image / Screenshot Fullscreen Lightbox Modal -->
    <div x-show="lightboxImage" 
         x-transition:enter="transition ease-out duration-200" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="transition ease-in duration-150" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-sm"
         style="display: none;"
         @keydown.escape.window="lightboxImage = null">
        
        <button @click="lightboxImage = null" class="absolute top-4 right-4 text-white/80 hover:text-white p-2 text-2xl transition z-10" aria-label="Close preview">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="relative max-w-4xl max-h-[90vh] flex flex-col items-center">
            <img :src="lightboxImage" alt="Enlarged screenshot view" class="max-w-full max-h-[80vh] rounded-2xl object-contain shadow-2xl border border-white/10">
            <div class="mt-4 flex gap-3">
                <a :href="lightboxImage" download target="_blank" class="btn btn-sm bg-white/20 hover:bg-white text-white hover:text-slate-900 border-none rounded-xl text-xs font-bold backdrop-blur">
                    <i class="fa-solid fa-download mr-1.5"></i> Download Full Resolution
                </a>
            </div>
        </div>
    </div>

</div>
