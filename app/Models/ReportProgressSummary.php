<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportProgressSummary extends Model
{
    use HasFactory;

    protected $table = 'report_progress_summary';

    protected $fillable = [

        'id',
        'report_id',
        'report_type',
        //Equity
        "subscription_fees",
        "capital_invested",
        "unit_owned",
        "app_dep",
        "investment_value",
        "unit_value",
        "total_dividends",
        "dividends_return",
        "sale_value",
        "realized_gain",
        "profit_loss",
        "realized",
        "unrealized",

        //Debt
        "fund_value_debt",
        "amount_raised_debt" ,
        "unit_price_debt" ,
        "total_units_debt",
        "lending_amount_debt",
        "murabha_rate_debt" ,
        "total_period_debt" ,
        "payment_requency_debt" ,
        "total_installments_debt",
        "installment_recieved_debt" ,
        "principle_amount_received_debt" ,
        "profit_amount_received_debt" ,
        "no_of_installments_received_debt" ,
        "next_installment_debt",
        "remaining_balance_debt" ,
        "remaining_period_debt",
        "roi_debt",
        "capital_invested_debt",
        "ownership_from_fund_debt",
        "installment_received_debt",
        "roi_amount_debt",
        "loss_of_principle",
        "subscription_fees_debt",
        "unrealized_profit_debt",
    ];

}
