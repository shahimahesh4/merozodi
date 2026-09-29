<?php

namespace App\Livewire;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InvoiceReceipt extends Component
{
    public Payment $payment;

    public function mount($paymentId)
    {
        $this->payment = Payment::with(['user.profile', 'subscription.plan'])->findOrFail($paymentId);

        // Security check: only invoice owner or admin can view
        if (Auth::id() !== $this->payment->user_id && !Auth::user()?->is_admin) {
            abort(403, 'Unauthorized access to this invoice.');
        }
    }

    public function getAmountInWordsProperty(): string
    {
        return self::numberToWords((float) $this->payment->total_amount);
    }

    public static function numberToWords(float $number): string
    {
        $no = floor($number);
        $fraction = round(($number - $no) * 100);
        $words = [
            0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five',
            6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten',
            11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen',
            15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty',
            50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy', 80 => 'Eighty',
            90 => 'Ninety'
        ];

        if ($no == 0) {
            $result = 'Zero';
        } else {
            $result = self::convertGroup($no, $words);
        }

        $result .= ' Nepali Rupees';

        if ($fraction > 0) {
            $paisaResult = self::convertGroup($fraction, $words);
            $result .= ' and ' . $paisaResult . ' Paisa';
        }

        return $result . ' Only';
    }

    protected static function convertGroup($number, $words): string
    {
        if ($number == 0) {
            return '';
        }

        $str = '';

        // Crores (1,00,00,000)
        if ($number >= 10000000) {
            $crores = floor($number / 10000000);
            $str .= self::convertGroup($crores, $words) . ' Crore ';
            $number %= 10000000;
        }

        // Lakhs (1,00,000)
        if ($number >= 100000) {
            $lakhs = floor($number / 100000);
            $str .= self::convertGroup($lakhs, $words) . ' Lakh ';
            $number %= 100000;
        }

        // Thousands (1,000)
        if ($number >= 1000) {
            $thousands = floor($number / 1000);
            $str .= self::convertGroup($thousands, $words) . ' Thousand ';
            $number %= 1000;
        }

        // Hundreds (100)
        if ($number >= 100) {
            $hundreds = floor($number / 100);
            $str .= $words[$hundreds] . ' Hundred ';
            $number %= 100;
        }

        if ($number > 0) {
            if ($number < 20) {
                $str .= $words[$number] . ' ';
            } else {
                $tens = floor($number / 10) * 10;
                $units = $number % 10;
                $str .= $words[$tens] . ($units ? '-' . $words[$units] : '') . ' ';
            }
        }

        return trim($str);
    }

    public function render()
    {
        return view('livewire/invoice-receipt', [
            'amountInWords' => $this->amountInWords,
        ])->layout('components.layouts.app', ['title' => 'Official Tax Invoice #' . $this->payment->transaction_id . ' - MeroZodi']);
    }
}
