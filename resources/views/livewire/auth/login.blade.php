<div class="py-10 sm:py-16 bg-slate-50 min-h-[75vh] flex items-center justify-center">
    <div class="max-w-md w-full mx-auto px-4">
        
        <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-xl border border-slate-200/80">
            <div class="text-center mb-6 sm:mb-8">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-600 text-[10px] font-black uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-lock"></i> Secure Member Login
                </span>
                <h1 class="text-2xl font-black text-slate-900">Welcome Back</h1>
                <p class="text-xs text-slate-500 mt-1">Log in to continue finding your life partner</p>
            </div>

            <form wire:submit="login" class="space-y-4">
                <div>
                    <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1">Email Address or Matrimony ID</label>
                    <input type="text" wire:model="email" class="input input-bordered w-full rounded-xl text-xs bg-slate-50 sm:bg-white focus:border-rose-500" placeholder="e.g. you@example.com or MZ000042">
                    @error('email') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1">Password</label>
                    <input type="password" wire:model="password" class="input input-bordered w-full rounded-xl text-xs bg-slate-50 sm:bg-white focus:border-rose-500" placeholder="••••••••">
                    @error('password') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                        <input type="checkbox" wire:model="remember" class="checkbox checkbox-sm checkbox-primary">
                        <span class="font-medium text-[11px]">Remember Me</span>
                    </label>
                    <a href="#" class="text-rose-600 hover:underline font-bold text-[11px]">Forgot Password?</a>
                </div>

                <button type="submit" class="w-full mt-4 py-3.5 bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-black text-xs rounded-xl sm:rounded-2xl shadow-lg shadow-rose-200 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 tap-active">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Sign In to Account
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center text-xs text-slate-500">
                Don't have an account yet? <a href="{{ route('register') }}" class="font-black text-rose-600 hover:underline">Register Free</a>
            </div>
        </div>

    </div>
</div>
