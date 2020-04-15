<?php

namespace AylesSoftware\XeroLaravel;

use XeroPHP\Application;
use BadMethodCallException;

class Xero extends Application
{
    public $modelMapping = [
        "contactGroups" => \XeroPHP\Models\Accounting\ContactGroup::class,
        "salesTaxBases" => \XeroPHP\Models\Accounting\SalesTaxBasis::class,
        "payments" => \XeroPHP\Models\Accounting\Payment::class,
        "trackingCategoryTrackingOptions" => \XeroPHP\Models\Accounting\TrackingCategory\TrackingOption::class,
        "brandingThemes" => \XeroPHP\Models\Accounting\BrandingTheme::class,
        "phones" => \XeroPHP\Models\Accounting\Phone::class,
        "attachments" => \XeroPHP\Models\Accounting\Attachment::class,
        "repeatingInvoiceSchedules" => \XeroPHP\Models\Accounting\RepeatingInvoice\Schedule::class,
        "repeatingInvoiceLineItems" => \XeroPHP\Models\Accounting\RepeatingInvoice\LineItem::class,
        "externalLinks" => \XeroPHP\Models\Accounting\ExternalLink::class,
        "bankTransactionBankAccounts" => \XeroPHP\Models\Accounting\BankTransaction\BankAccount::class,
        "bankTransactionLineItems" => \XeroPHP\Models\Accounting\BankTransaction\LineItem::class,
        "receiptLineItems" => \XeroPHP\Models\Accounting\Receipt\LineItem::class,
        "taxRates" => \XeroPHP\Models\Accounting\TaxRate::class,
        "itemPurchases" => \XeroPHP\Models\Accounting\Item\Purchase::class,
        "itemSales" => \XeroPHP\Models\Accounting\Item\Sale::class,
        "bankTransfers" => \XeroPHP\Models\Accounting\BankTransfer::class,
        "organisationBills" => \XeroPHP\Models\Accounting\Organisation\Bill::class,
        "organisationExternalLinks" => \XeroPHP\Models\Accounting\Organisation\ExternalLink::class,
        "organisationSales" => \XeroPHP\Models\Accounting\Organisation\Sale::class,
        "organisationPaymentTerms" => \XeroPHP\Models\Accounting\Organisation\PaymentTerm::class,
        "purchaseOrderLineItems" => \XeroPHP\Models\Accounting\PurchaseOrder\LineItem::class,
        "contacts" => \XeroPHP\Models\Accounting\Contact::class,
        "users" => \XeroPHP\Models\Accounting\User::class,
        "invoices" => \XeroPHP\Models\Accounting\Invoice::class,
        "manualJournalJournalLines" => \XeroPHP\Models\Accounting\ManualJournal\JournalLine::class,
        "accounts" => \XeroPHP\Models\Accounting\Account::class,
        "journals" => \XeroPHP\Models\Accounting\Journal::class,
        "reportTaxTypes" => \XeroPHP\Models\Accounting\ReportTaxType::class,
        "prepayments" => \XeroPHP\Models\Accounting\Prepayment::class,
        "bankTransactions" => \XeroPHP\Models\Accounting\BankTransaction::class,
        "taxRateTaxComponents" => \XeroPHP\Models\Accounting\TaxRate\TaxComponent::class,
        "reportBankSummaries" => \XeroPHP\Models\Accounting\Report\BankSummary::class,
        "reportBankStatements" => \XeroPHP\Models\Accounting\Report\BankStatement::class,
        "reportAgedReceivablesByContacts" => \XeroPHP\Models\Accounting\Report\AgedReceivablesByContact::class,
        "reportBalanceSheets" => \XeroPHP\Models\Accounting\Report\BalanceSheet::class,
        "reportExecutiveSummaries" => \XeroPHP\Models\Accounting\Report\ExecutiveSummary::class,
        "reportReports" => \XeroPHP\Models\Accounting\Report\Report::class,
        "reportTrialBalances" => \XeroPHP\Models\Accounting\Report\TrialBalance::class,
        "reportTenNinetyNines" => \XeroPHP\Models\Accounting\Report\TenNinetyNine::class,
        "reportAgedPayablesByContacts" => \XeroPHP\Models\Accounting\Report\AgedPayablesByContact::class,
        "reportBudgetSummaries" => \XeroPHP\Models\Accounting\Report\BudgetSummary::class,
        "reportProfitLosses" => \XeroPHP\Models\Accounting\Report\ProfitLoss::class,
        "invoiceReminders" => \XeroPHP\Models\Accounting\InvoiceReminder::class,
        "contactContactPeople" => \XeroPHP\Models\Accounting\Contact\ContactPerson::class,
        "batchPayments" => \XeroPHP\Models\Accounting\BatchPayment::class,
        "salesTaxPeriods" => \XeroPHP\Models\Accounting\SalesTaxPeriod::class,
        "paymentServices" => \XeroPHP\Models\Accounting\PaymentService::class,
        "overpayments" => \XeroPHP\Models\Accounting\Overpayment::class,
        "creditNoteAllocations" => \XeroPHP\Models\Accounting\CreditNote\Allocation::class,
        "repeatingInvoices" => \XeroPHP\Models\Accounting\RepeatingInvoice::class,
        "invoiceLineItems" => \XeroPHP\Models\Accounting\Invoice\LineItem::class,
        "addresses" => \XeroPHP\Models\Accounting\Address::class,
        "manualJournals" => \XeroPHP\Models\Accounting\ManualJournal::class,
        "expenseClaimExpenseClaims" => \XeroPHP\Models\Accounting\ExpenseClaim\ExpenseClaim::class,
        "currencies" => \XeroPHP\Models\Accounting\Currency::class,
        "trackingCategories" => \XeroPHP\Models\Accounting\TrackingCategory::class,
        "linkedTransactions" => \XeroPHP\Models\Accounting\LinkedTransaction::class,
        "overpaymentAllocations" => \XeroPHP\Models\Accounting\Overpayment\Allocation::class,
        "overpaymentLineItems" => \XeroPHP\Models\Accounting\Overpayment\LineItem::class,
        "journalJournalLines" => \XeroPHP\Models\Accounting\Journal\JournalLine::class,
        "employees" => \XeroPHP\Models\Accounting\Employee::class,
        "bankTransferFromBankAccounts" => \XeroPHP\Models\Accounting\BankTransfer\FromBankAccount::class,
        "bankTransferToBankAccounts" => \XeroPHP\Models\Accounting\BankTransfer\ToBankAccount::class,
        "expenseClaims" => \XeroPHP\Models\Accounting\ExpenseClaim::class,
        "items" => \XeroPHP\Models\Accounting\Item::class,
        "creditNotes" => \XeroPHP\Models\Accounting\CreditNote::class,
        "organisations" => \XeroPHP\Models\Accounting\Organisation::class,
        "purchaseOrders" => \XeroPHP\Models\Accounting\PurchaseOrder::class,
        "receipts" => \XeroPHP\Models\Accounting\Receipt::class,
        "userRoles" => \XeroPHP\Models\Accounting\UserRole::class,
        "prepaymentAllocations" => \XeroPHP\Models\Accounting\Prepayment\Allocation::class,
        "prepaymentLineItems" => \XeroPHP\Models\Accounting\Prepayment\LineItem::class,
        "taxTypes" => \XeroPHP\Models\Accounting\TaxType::class,
        "histories" => \XeroPHP\Models\Accounting\History::class,
        "assetsOverviews" => \XeroPHP\Models\Assets\Overview::class,
        "assetsSettings" => \XeroPHP\Models\Assets\Setting::class,
        "assetsAssetTypes" => \XeroPHP\Models\Assets\AssetType::class,
        "assetsAssetTypeBookDepreciationSettings" => \XeroPHP\Models\Assets\AssetType\BookDepreciationSetting::class,
        "filesAssociations" => \XeroPHP\Models\Files\Association::class,
        "filesFiles" => \XeroPHP\Models\Files\File::class,
        "filesFolders" => \XeroPHP\Models\Files\Folder::class,
        "filesObjects" => \XeroPHP\Models\Files\Object::class,
        "payrollAUSuperFundSuperFunds" => \XeroPHP\Models\PayrollAU\SuperFund\SuperFund::class,
        "payrollAUPayRuns" => \XeroPHP\Models\PayrollAU\PayRun::class,
        "payrollAUPayrollCalendars" => \XeroPHP\Models\PayrollAU\PayrollCalendar::class,
        "payrollAUPayItemLeaveTypes" => \XeroPHP\Models\PayrollAU\PayItem\LeaveType::class,
        "payrollAUPayItemEarningsRates" => \XeroPHP\Models\PayrollAU\PayItem\EarningsRate::class,
        "payrollAUPayItemReimbursementTypes" => \XeroPHP\Models\PayrollAU\PayItem\ReimbursementType::class,
        "payrollAUPayItemDeductionTypes" => \XeroPHP\Models\PayrollAU\PayItem\DeductionType::class,
        "payrollAUSettingAccounts" => \XeroPHP\Models\PayrollAU\Setting\Account::class,
        "payrollAUSettingTrackingCategories" => \XeroPHP\Models\PayrollAU\Setting\TrackingCategory::class,
        "payrollAUPayslipTaxLines" => \XeroPHP\Models\PayrollAU\Payslip\TaxLine::class,
        "payrollAUPayslipTimesheetEarningsLines" => \XeroPHP\Models\PayrollAU\Payslip\TimesheetEarningsLine::class,
        "payrollAUPayslipLeaveEarningsLines" => \XeroPHP\Models\PayrollAU\Payslip\LeaveEarningsLine::class,
        "payrollAUPayslipDeductionLines" => \XeroPHP\Models\PayrollAU\Payslip\DeductionLine::class,
        "payrollAUPayslipLeaveAccrualLines" => \XeroPHP\Models\PayrollAU\Payslip\LeaveAccrualLine::class,
        "payrollAUPayslipEarningsLines" => \XeroPHP\Models\PayrollAU\Payslip\EarningsLine::class,
        "payrollAUPayslipReimbursementLines" => \XeroPHP\Models\PayrollAU\Payslip\ReimbursementLine::class,
        "payrollAUPayslipSuperannuationLines" => \XeroPHP\Models\PayrollAU\Payslip\SuperannuationLine::class,
        "payrollAUSettings" => \XeroPHP\Models\PayrollAU\Setting::class,
        "payrollAUSuperFunds" => \XeroPHP\Models\PayrollAU\SuperFund::class,
        "payrollAUPayslips" => \XeroPHP\Models\PayrollAU\Payslip::class,
        "payrollAUTimesheets" => \XeroPHP\Models\PayrollAU\Timesheet::class,
        "payrollAUTimesheetTimesheetLines" => \XeroPHP\Models\PayrollAU\Timesheet\TimesheetLine::class,
        "payrollAUSuperFundProducts" => \XeroPHP\Models\PayrollAU\SuperFundProduct::class,
        "payrollAULeaveApplications" => \XeroPHP\Models\PayrollAU\LeaveApplication::class,
        "payrollAUEmployees" => \XeroPHP\Models\PayrollAU\Employee::class,
        "payrollAUPayItems" => \XeroPHP\Models\PayrollAU\PayItem::class,
        "payrollAUEmployeePayTemplates" => \XeroPHP\Models\PayrollAU\Employee\PayTemplate::class,
        "payrollAUEmployeeSuperMemberships" => \XeroPHP\Models\PayrollAU\Employee\SuperMembership::class,
        "payrollAUEmployeeOpeningBalances" => \XeroPHP\Models\PayrollAU\Employee\OpeningBalance::class,
        "payrollAUEmployeeBankAccounts" => \XeroPHP\Models\PayrollAU\Employee\BankAccount::class,
        "payrollAUEmployeeLeaveBalances" => \XeroPHP\Models\PayrollAU\Employee\LeaveBalance::class,
        "payrollAUEmployeeTaxDeclarations" => \XeroPHP\Models\PayrollAU\Employee\TaxDeclaration::class,
        "payrollAUEmployeePayTemplateDeductionLines" => \XeroPHP\Models\PayrollAU\Employee\PayTemplate\DeductionLine::class,
        "payrollAUEmployeePayTemplateEarningsLines" => \XeroPHP\Models\PayrollAU\Employee\PayTemplate\EarningsLine::class,
        "payrollAUEmployeePayTemplateReimbursementLines" => \XeroPHP\Models\PayrollAU\Employee\PayTemplate\ReimbursementLine::class,
        "payrollAUEmployeePayTemplateSuperLines" => \XeroPHP\Models\PayrollAU\Employee\PayTemplate\SuperLine::class,
        "payrollAUEmployeePayTemplateLeaveLines" => \XeroPHP\Models\PayrollAU\Employee\PayTemplate\LeaveLine::class,
        "payrollAUEmployeeHomeAddresses" => \XeroPHP\Models\PayrollAU\Employee\HomeAddress::class,
        "payrollAULeaveApplicationLeavePeriods" => \XeroPHP\Models\PayrollAU\LeaveApplication\LeavePeriod::class,
        "payrollUSPaystubs" => \XeroPHP\Models\PayrollUS\Paystub::class,
        "payrollUSSalaryandWages" => \XeroPHP\Models\PayrollUS\SalaryandWage::class,
        "payrollUSPayRuns" => \XeroPHP\Models\PayrollUS\PayRun::class,
        "payrollUSPayItemEarningsTypes" => \XeroPHP\Models\PayrollUS\PayItem\EarningsType::class,
        "payrollUSPayItemTimeOffTypes" => \XeroPHP\Models\PayrollUS\PayItem\TimeOffType::class,
        "payrollUSPayItemReimbursementTypes" => \XeroPHP\Models\PayrollUS\PayItem\ReimbursementType::class,
        "payrollUSPayItemBenefitTypes" => \XeroPHP\Models\PayrollUS\PayItem\BenefitType::class,
        "payrollUSPayItemDeductionTypes" => \XeroPHP\Models\PayrollUS\PayItem\DeductionType::class,
        "payrollUSSettingAccounts" => \XeroPHP\Models\PayrollUS\Setting\Account::class,
        "payrollUSSettingTrackingCategories" => \XeroPHP\Models\PayrollUS\Setting\TrackingCategory::class,
        "payrollUSPaySchedules" => \XeroPHP\Models\PayrollUS\PaySchedule::class,
        "payrollUSSettings" => \XeroPHP\Models\PayrollUS\Setting::class,
        "payrollUSWorkLocations" => \XeroPHP\Models\PayrollUS\WorkLocation::class,
        "payrollUSPaystubTimesheetEarningsLines" => \XeroPHP\Models\PayrollUS\Paystub\TimesheetEarningsLine::class,
        "payrollUSPaystubLeaveEarningsLines" => \XeroPHP\Models\PayrollUS\Paystub\LeaveEarningsLine::class,
        "payrollUSPaystubDeductionLines" => \XeroPHP\Models\PayrollUS\PaystubDeductionLine::class,
        "payrollUSPaystubTimeOffLines" => \XeroPHP\Models\PayrollUS\Paystub\TimeOffLine::class,
        "payrollUSPaystubEarningsLines" => \XeroPHP\Models\PayrollUS\Paystub\EarningsLine::class,
        "payrollUSPaystubBenefitLines" => \XeroPHP\Models\PayrollUS\Paystub\BenefitLine::class,
        "payrollUSPaystubReimbursementLines" => \XeroPHP\Models\PayrollUS\Paystub\ReimbursementLine::class,
        "payrollUSTimesheets" => \XeroPHP\Models\PayrollUS\Timesheet::class,
        "payrollUSTimesheetTimesheetLines" => \XeroPHP\Models\PayrollUS\Timesheet\TimesheetLine::class,
        "payrollUSEmployees" => \XeroPHP\Models\PayrollUS\Employee::class,
        "payrollUSPayItems" => \XeroPHP\Models\PayrollUS\PayItem::class,
        "payrollUSEmployeeTimeOffBalances" => \XeroPHP\Models\PayrollUS\Employee\TimeOffBalance::class,
        "payrollUSEmployeePayTemplates" => \XeroPHP\Models\PayrollUS\Employee\PayTemplate::class,
        "payrollUSEmployeeOpeningBalances" => \XeroPHP\Models\PayrollUS\Employee\OpeningBalance::class,
        "payrollUSEmployeeWorkLocations" => \XeroPHP\Models\PayrollUS\Employee\WorkLocation::class,
        "payrollUSEmployeeBankAccounts" => \XeroPHP\Models\PayrollUS\Employee\BankAccount::class,
        "payrollUSEmployeePaymentMethods" => \XeroPHP\Models\PayrollUS\Employee\PaymentMethod::class,
        "payrollUSEmployeeSalaryAndWages" => \XeroPHP\Models\PayrollUS\Employee\SalaryAndWage::class,
        "payrollUSEmployeeMailingAddresses" => \XeroPHP\Models\PayrollUS\Employee\MailingAddress::class,
        "payrollUSEmployeeHomeAddresses" => \XeroPHP\Models\PayrollUS\Employee\HomeAddress::class,
    ];

    public function __call($name, $arguments)
    {
        $relationships = array_keys($this->modelMapping);

        if (! in_array($name, $relationships)) {
            throw new BadMethodCallException();
        }

        return new QueryBuilder($this->load($this->modelMapping[$name]), $this);
    }
}