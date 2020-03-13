# Xero Laravel

Xero Laravel provides a wrapper around xero.

## Requirements

- Laravel 6+
- PHP 7.2+

## Installation

Install via using composer

```bash
composer require ayles-software/xero-laravel
```

## Setup

Publish the config.

```bash
php artisan vendor:publish --provider="AylesSoftware\XeroLaravel\ServiceProvider"
```

You now need to populate the `config/xero-laravel.php` file with the credentials for 
your Xero app. You can create apps and find therequired credentials in the 
[My Apps](https://developer.xero.com/myapps/) section of your Xero account. 
Add the following variables to your `.env` file.

```
XERO_REDIRECT_URL=
XERO_CLIENT_ID=
XERO_CLIENT_SECRET=
```

The config file also contains scopes Xero access. 
The `offline_access` scope is required to obtain a new access token. Access tokens **expire after 30 minutes**.
For more information on scopes try the [xero documentation](https://developer.xero.com/documentation/oauth2/scopes).  

#### Migrations

This package uses `XeroAccess` model to manage access tokens. Run the migration to create this table.

## OAuth flow

First you must authorize the application, this will require a controller and route to be setup. 
Once the application has been authorized then access to Xero is self managed within this package. 
Once the access token expires, a new one will be request as needed.

`XeroOAuth::class` will provides the OAuth flow and regeneration of the access token.

Example of Controller for authorization.
```php
<?php

namespace App\Http\Controllers;

use AylesSoftware\XeroLaravel\XeroOAuth;

class XeroOAuthController extends Controller
{
    public function __invoke(XeroOAuth $xeroOAuth)
    {
        return $xeroOAuth->flow();
    }
}
``` 

## Usage

```php
use AylesSoftware\XeroLaravel\Facades\Xero;

# Retrieve all contacts 
$contacts = Xero::contacts()->get();

# Retrieve an individual contact by its GUID
$contact =  Xero::contacts()->find('34xxxx6e-7xx5-2xx4-bxx5-6123xxxxea49');

# Retrieve contacts filtered by name
$contacts = Xero::contacts()->where('Name', 'ANZ')->get();

# Retrieve an individual contact filtered by name
$contact = Xero::contacts()->where('Name', 'ANZ')->first();

# Retrieve an individual contact by its GUID
$contact = Xero::contacts()->find('34xxxx6e-7xx5-2xx4-bxx5-6123xxxxea49');

# Retrieve multiple contact by their GUIDS
$contacts = Xero::contacts()->find([
    '34xxxx6e-7xx5-2xx4-bxx5-6123xxxxea49',
    '364xxxx7f-2xx3-7xx3-gxx7-6726xxxxhe76',
]);
```

For more information on usage checkout https://github.com/calcinai/xero-php.

### Credit

This package was inspired by the talented people at [Langley Foxall](https://github.com/langleyfoxall/xero-laravel).

### Available relationships

The list below shows all available relationships that can be used to access 
data related to your Xero application (e.g. `$xero->relationshipName`). 

*Note: Some of these relationships may not be available if the related 
service(s) are not enabled for your Xero account.*

```
accounts
addresses
assetsAssetTypeBookDepreciationSettings
assetsAssetTypes
assetsOverviews
assetsSettings
attachments
bankTransactionBankAccounts
bankTransactionLineItems
bankTransactions
bankTransferFromBankAccounts
bankTransferToBankAccounts
bankTransfers
brandingThemes
contactContactPeople
contactGroups
contacts
creditNoteAllocations
creditNotes
currencies
employees
expenseClaimExpenseClaims
expenseClaims
externalLinks
filesAssociations
filesFiles
filesFolders
filesObjects
invoiceLineItems
invoiceReminders
invoices
itemPurchases
itemSales
items
journalJournalLines
journals
linkedTransactions
manualJournalJournalLines
manualJournals
organisationBills
organisationExternalLinks
organisationPaymentTerms
organisationSales
organisations
overpaymentAllocations
overpaymentLineItems
overpayments
payments
payrollAUEmployeeBankAccounts
payrollAUEmployeeHomeAddresses
payrollAUEmployeeLeaveBalances
payrollAUEmployeeOpeningBalances
payrollAUEmployeePayTemplateDeductionLines
payrollAUEmployeePayTemplateEarningsLines
payrollAUEmployeePayTemplateLeaveLines
payrollAUEmployeePayTemplateReimbursementLines
payrollAUEmployeePayTemplateSuperLines
payrollAUEmployeePayTemplates
payrollAUEmployeeSuperMemberships
payrollAUEmployeeTaxDeclarations
payrollAUEmployees
payrollAULeaveApplicationLeavePeriods
payrollAULeaveApplications
payrollAUPayItemDeductionTypes
payrollAUPayItemEarningsRates
payrollAUPayItemLeaveTypes
payrollAUPayItemReimbursementTypes
payrollAUPayItems
payrollAUPayRuns
payrollAUPayrollCalendars
payrollAUPayslipDeductionLines
payrollAUPayslipEarningsLines
payrollAUPayslipLeaveAccrualLines
payrollAUPayslipLeaveEarningsLines
payrollAUPayslipReimbursementLines
payrollAUPayslipSuperannuationLines
payrollAUPayslipTaxLines
payrollAUPayslipTimesheetEarningsLines
payrollAUPayslips
payrollAUSettingAccounts
payrollAUSettingTrackingCategories
payrollAUSettings
payrollAUSuperFundProducts
payrollAUSuperFundSuperFunds
payrollAUSuperFunds
payrollAUTimesheetTimesheetLines
payrollAUTimesheets
payrollUSEmployeeBankAccounts
payrollUSEmployeeHomeAddresses
payrollUSEmployeeMailingAddresses
payrollUSEmployeeOpeningBalances
payrollUSEmployeePayTemplates
payrollUSEmployeePaymentMethods
payrollUSEmployeeSalaryAndWages
payrollUSEmployeeTimeOffBalances
payrollUSEmployeeWorkLocations
payrollUSEmployees
payrollUSPayItemBenefitTypes
payrollUSPayItemDeductionTypes
payrollUSPayItemEarningsTypes
payrollUSPayItemReimbursementTypes
payrollUSPayItemTimeOffTypes
payrollUSPayItems
payrollUSPayRuns
payrollUSPaySchedules
payrollUSPaystubBenefitLines
payrollUSPaystubDeductionLines
payrollUSPaystubEarningsLines
payrollUSPaystubLeaveEarningsLines
payrollUSPaystubReimbursementLines
payrollUSPaystubTimeOffLines
payrollUSPaystubTimesheetEarningsLines
payrollUSPaystubs
payrollUSSalaryandWages
payrollUSSettingAccounts
payrollUSSettingTrackingCategories
payrollUSSettings
payrollUSTimesheetTimesheetLines
payrollUSTimesheets
payrollUSWorkLocations
phones
prepaymentAllocations
prepaymentLineItems
prepayments
purchaseOrderLineItems
purchaseOrders
receiptLineItems
receipts
repeatingInvoiceLineItems
repeatingInvoiceSchedules
repeatingInvoices
reportBalanceSheets
reportBankStatements
reportBudgetSummaries
reportProfitLosses
reportReports
reportTaxTypes
salesTaxBases
salesTaxPeriods
taxRateTaxComponents
taxRates
taxTypes
trackingCategories
trackingCategoryTrackingOptions
userRoles
users
```

## License

Xero Laravel is open-sourced software licensed under the [MIT license](https://github.com/ayles-software/xero-laravel/blob/master/LICENSE.md).
