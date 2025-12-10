<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Str;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'invoice_number',
        'invoice_date',
        'due_date',

        'subtotal',
        'discount_percent',
        'discount_amount',

        'cgst_percent',
        'cgst_amount',

        'sgst_percent',
        'sgst_amount',

        'gst_percent',
        'gst_amount',

        'convenience_fee_percent',
        'convenience_fee_amount',
        'grand_total',

        'status',
        'payment_date',
        'payment_method',
        'transaction_id',
        'pdf_path',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'payment_date' => 'date',
    ];

    /**
     * Auto-generate invoice number if not provided
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (! $invoice->invoice_number) {
                $invoice->invoice_number = 'INV-' . strtoupper(Str::random(8));
            }

            if (! $invoice->invoice_date) {
                $invoice->invoice_date = now();
            }
        });
    }

    /**
     * Relationships
     */

    // Invoice belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Invoice belongs to a Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Helper: Calculate final total
     */
    public function calculateTotals()
    {
        $this->discount_amount = ($this->subtotal * $this->discount_percent) / 100;

        $this->cgst_amount = ($this->subtotal * $this->cgst_percent) / 100;
        $this->sgst_amount = ($this->subtotal * $this->sgst_percent) / 100;

        $this->gst_amount = $this->cgst_amount + $this->sgst_amount;

        $this->grand_total =
            $this->subtotal
            - $this->discount_amount
            + $this->gst_amount
            + $this->convenience_fee;

        return $this;
    }
}
