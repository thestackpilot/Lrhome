<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use View;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\CommonController;

class GenericReportsController extends DashboardController
{
    protected $statuses = [];

    private $sales_order_statuses = [['value' => '', 'label' => 'All']];
    private $customers_order_statuses = [['value' => '', 'label' => 'All']];

    public function __construct()
    {
        parent::__construct();

        $statuses = $this->ApiObj->Get_AllStatus();

        if ( $statuses['Success'] )
        {

            foreach ( $statuses['StatusList'] as $status )
            {

                if ( $status['SearchID'] == 'SalesOrder' || $status['SearchID'] == 'SalesOrders' )
                {
                    $this->sales_order_statuses[] =
                        [
                        'value' => $status['StatusID'],
                        'label' => $status['Description']
                    ];
                }

            }

        }

        $this->sales_order_statuses = array_unique( $this->sales_order_statuses, SORT_REGULAR );
    }

    // TODO : The dashboard for the LR needs to have the icons.
    public function company_credit( Request $request )
    {
        $active_customer = $request->has( 'customer' ) ? $request->customer : (Auth::user()->is_customer ? Auth::user()->customer_id : 0);
        $customers       = $this->get_customers_dropdown_options( false );

        if ( ! $active_customer && count( $customers ) > 1 )
        {
            $active_customer = $customers[0]['value'];
        }

        if ( $active_customer )
        {
            $company_credit = $this->ApiObj->Get_CompanyCredit('000158');

            if ( $company_credit )
            {
                $company_credit = $company_credit['OutPut'];
            }

        }
        else
        {
            $company_credit = [
                'PaymentTerms'       => 'N/A',
                'CreditLimit'        => 'N/A',
                'OutstandingBalance' => 'N/A',
                'AvailableCredit'    => 'N/A'
            ];
        }

        View::share( 'active_customer', $active_customer );
        View::share( 'customers', $customers );
        View::share( 'company_credit', $company_credit );

        $report_type = isset( $request->report_type ) && $request->report_type ? $request->report_type : 'credit-memos';

        switch ( $report_type )
        {
            case 'credit-memos':
                $data = $this->get_credit_memos( $request );
                View::share( 'additional_data', ['title' => 'Credit Memos'] );
                View::share( 'memos', $data['memos'] );
                break;
            case 'debit-memos':
                $data = $this->get_debit_memos( $request );
                View::share( 'additional_data', ['title' => 'Debit Memos'] );
                View::share( 'memos', $data['memos'] );
                break;
            case 'invoices':
                $data = $this->get_invoices( $request );
                View::share( 'additional_data', ['title' => 'Invoices'] );
                View::share( 'invoices', $data['invoices'] );
                break;
        }

        array_unshift( $data['filters'], [
            'title'        => 'Report Type',
            'type'         => 'radio',
            'placeholder'  => '',
            'filter_width' => 'col-md-12',
            'value'        => $report_type,
            'options'      => [
                'credit-memos' => 'Credit Memos',
                'debit-memos'  => 'Debit Memos',
                'invoices'     => 'Invoices'
            ]
        ] );
        View::share( 'table', $data['table'] );
        View::share( 'filters', $data['filters'] );
        View::share( 'paginated', 'yes' );

        return view( 'dashboard.company-credit' );
    }

    public function credit_memos( Request $request )
    {
        $data = $this->get_credit_memos( $request );
        View::share( 'memos', $data['memos'] );
        View::share( 'table', $data['table'] );
        View::share( 'filters', $data['filters'] );
        View::share( 'title', 'Credit Memos' );
        View::share( 'paginated', 'yes' );

        return view( 'dashboard.generic-report' );
    }

    public function order_report(Request $request)
    {
        try {
            $SalesRepId = $request->has('SalesRepId') ? $request->SalesRepId : '';
            $CustomerId = $request->has('CustomerId') ? $request->CustomerId : '';
            $MenuTag = $request->has('MenuTag') ? $request->MenuTag : 'View Order';
            $DocumentNo = $request->has('DocumentNo') ? $request->DocumentNo : 0000;
            $report = $this->ApiObj->Get_ViewDocumentsReport($SalesRepId, $CustomerId, $MenuTag, $DocumentNo);
            if( $report['document']['Success'] )
            {
                View::share( 'ReportData', $report['document']['ReportData'] );
                return $report['document']['ReportData'];
            } else {
                return $report;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred. Please try again later.']);
        }
    }

    public function download_print_orders( Request $request )
    {

        if ( isset( $request->report_data ) && is_array( json_decode( $request->report_data, 1 ) ) )
        {
            $report_data = $request->report_data;
            $report_data = json_decode($report_data, true);
            View::share( 'report_data', $report_data );

            return view( 'dashboard.order-report-pdf' );
        }
        else
        {
            return redirect()->back();
        }

    }

    public function download_sample_files( $type = '' )
    {
        $data = $columns = [];

        switch ( $type )
        {
            case 'order':
                $columns = ['Item ID', 'Quantity'];
                $data    = [
                    ['Item ID' => 'COVT12331GYIV2222', 'Quantity' => 10, 'SideMark' => 'SideMark 1'],
                    ['Item ID' => 'COVT12331GYIV2223', 'Quantity' => 20, 'SideMark' => 'SideMark 2'],
                    ['Item ID' => 'COVT12331GYIV2224', 'Quantity' => 3, 'SideMark' => 'SideMark 3'],
                    ['Item ID' => 'COVT12331GYIV2225', 'Quantity' => 9, 'SideMark' => 'SideMark 4']
                ];
                break;
            case 'hangtag':
                $columns = ['Design ID'];
                $data    = [
                    ['Design ID' => '03337'],
                    ['Design ID' => '03302'],
                    ['Design ID' => '03334']
                ];
                break;
            default:
                return redirect()->route( 'dashboard' );
                break;
        }

        return response()->stream( function () use ( $data, $columns )
        {
            $file = fopen( 'php://output', 'w' );
            fputcsv( $file, $columns );

            foreach ( $data as $row )
            {
                fputcsv( $file, $row );
            }

            fclose( $file );
        }, 200, [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename={$type}-sample.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ] );

    }

    public function financial_transactions( Request $request )
    {
        $return = ['transactions' => [], 'table' => [], 'filters' => []];

        if ( count( $request->all() ) > 0 )
        {

// TODO - Needs to be improvised
            if ( $request->has( 'draw' ) && $request->draw )
            {
                $page      = $request->start == 0 ? 1 : ( $request->start / $request->length ) + 1;
                $page_size = $request->length;
            }
            else
            {
                $page      = 1;
                $page_size = 25;
            }

            $transactions = $this->ApiObj->Get_FinancialTransactions( $request->customer, $request->sales_rep, $request->from_date, $request->to_date, $request->po_number, $request->invoice_number, $request->cash_receipt_number, $page, $page_size );
            $table        = array( 'thead' => [
                'transaction_number' => 'Transaction Number',
                'transaction_date'   => 'Transaction Date',
                'total_quantity'     => 'Total Quantity',
                'customer_id'        => 'Customer Id',
                'status'             => 'Status',
                'total_amount'       => 'Total Amount',
                'transaction_type'   => 'Transaction Type',
                'actions'            => 'Actions',
            ], 'tbody' => [] );

            if ( isset( $transactions['FinancialTransactions'] ) )
            {

                foreach ( $transactions['FinancialTransactions'] as $transaction )
                {
                    foreach($transaction['Details'] as $index => $view)
                    {
                        $column = CommonController::get_selected_columns($view, [
                            'ImageName', 'ItemID', 'ItemDescription', 'Price', 'OrderQuantity', 'ExtPrice', 'LineNo', 'InvoicedQuantity', 'OpenQuantity'
                        ]);
                        $transaction['Details'][$index] = $column;
                    }

                    $transaction_number = $transaction['SalesInvoiceNo'] ? $transaction['SalesInvoiceNo'] : ( $transaction['CashReceiptNo'] ? $transaction['CashReceiptNo'] : 'N/A' );

                    $table['tbody'][] = [
                        'transaction_number' => $transaction['SalesInvoiceNo'] ? $transaction['SalesInvoiceNo'] : ( $transaction['CashReceiptNo'] ? $transaction['CashReceiptNo'] : 'N/A' ),
                        'transaction_date'   => isset( $transaction['TransactionDate'] ) ? CommonController::get_date_format( $transaction['TransactionDate'] ) : 'N/A',
                        'total_quantity'     => isset( $transaction['TotalQty'] ) ? $transaction['TotalQty'] : 'N/A',
                        'total_amount'       => ConstantsController::CURRENCY.number_format( $transaction['TotalAmount'], ConstantsController::ALLOWED_DECIMALS ),
                        'transaction_type'   => $transaction['TransactionType'],
                        'customer_id'        => isset( $transaction['CustomerID'] ) ? $transaction['CustomerID'] : 'N/A',
                        'status'             => isset( $transaction['Status'] ) ? $transaction['Status'] : 'N/A',
                        'actions'            => $transaction['TransactionType'] === 'Cash Receipt' ? [['type' => 'modal', 'label' => 'View Reports']] : [['type' => 'modal', 'label' => 'View Details']],
//                        'other_actions' => [['type' => 'modal', 'label' => 'View Reports']],
                        'other_actions_details' => [
                            'OrderNo'   => $transaction_number,
                        ],
                        'details'            => [
                            'heading' => $transaction['SalesInvoiceNo'] ? $transaction['SalesInvoiceNo'] : ( $transaction['CashReceiptNo'] ? $transaction['CashReceiptNo'] : 'N/A' ),
                            'body'    => [
                                'sections' => [
                                    [
                                        'title'   => 'General',
                                        'content' => [
                                            'transaction_number' => $transaction_number,
                                            'transaction_date'   => isset( $transaction['TransactionDate'] ) ? CommonController::get_date_format( $transaction['TransactionDate'] ) : 'N/A',
                                            'total_quantity'     => isset( $transaction['TotalQty'] ) ? $transaction['TotalQty'] : 'N/A',
                                            'total_amount'       => ConstantsController::CURRENCY.number_format( $transaction['TotalAmount'], ConstantsController::ALLOWED_DECIMALS ),
                                            'transaction_type'   => $transaction['TransactionType'],
                                            'customer_id'        => isset( $transaction['CustomerID'] ) ? $transaction['CustomerID'] : 'N/A',
                                            'status'             => isset( $transaction['Status'] ) ? $transaction['Status'] : 'N/A'
                                        ],
                                        'cols' => 6
                                    ],
                                    [
                                        'title'   => 'Billing Details',
                                        'content' => $transaction['BillToAddress'],
                                        'cols' => 6,
                                        'hide_labels' => 1
                                    ],
                                    [
                                        'title'   => 'Shipping Details',
                                        'content' => $transaction['ShipToAddress'],
                                        'cols' => 6,
                                        'hide_labels' => 1
                                    ],
                                    [
                                        'title'   => 'Detail',
                                        'content' => $transaction['Details'],
                                        'cols' => 12
                                    ]

                                ]
                            ]
                        ]

                    ];
                }

                if ( $request->has( 'draw' ) && $request->draw )
                {
                    die( json_encode(
                        [
                            'recordsFiltered' => $transactions['TotalRows'],
                            'recordsTotal'    => $transactions['TotalRows'],
                            'draw'            => $request->draw + 1,
                            'data'            => $table['tbody']
                        ]
                    ) );
                }

            }

            View::share( 'transactions', $transactions );
            View::share( 'table', $table );
        }

        $filters = [
            [
                'title'       => 'Sales Rep',
                'type'        => 'hidden',
                'placeholder' => '',
                'value'       => Auth::user()->is_sale_rep ? Auth::user()->customer_id : ''
            ],
            [
                'title'       => 'From Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => $request->from_date ? $request->from_date : CommonController::get_date_format( '-1 month' )
            ],
            [
                'title'       => 'To Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => $request->to_date ? $request->to_date : CommonController::get_date_format( date( 'Y-m-d' ) )
            ],
            [
                'title'       => 'Customer',
                'type'        => Auth::user()->is_customer ? 'hidden' : 'select',
                'options'     => $this->get_customers_dropdown_options(),
                'placeholder' => '',
                'value'       => $request->has( 'customer' ) ? $request->customer : Auth::user()->customer_id
            ],
            [
                'title'       => 'PO Number',
                'type'        => 'text',
                'placeholder' => '',
                'attribues'   => ' maxlength="255" ',
                'value'       => $request->po_number
            ],
            [
                'title'       => 'Invoice Number',
                'type'        => 'number',
                'attribues'   => ' maxlength="255" ',
                'placeholder' => '',
                'value'       => $request->invoice_number
            ],

            [
                'title'       => 'Cash Receipt Number',
                'type'        => 'number',
                'attribues'   => ' maxlength="255" ',
                'placeholder' => '',
                'value'       => $request->cash_receipt_number
            ]
        ];

        View::share( 'filters', $filters );
        View::share( 'title', 'Financial Transactions' );
        View::share( 'paginated', 'yes' );

        return view( 'dashboard.generic-report' );
    }

    // TODO : The dashboard for the LR needs to have the icons.
    public function get_credit_memos( Request $request )
    {

        $return = ['memos' => [], 'table' => [], 'filters' => []];

        if ( count( $request->all() ) > 0 && isset( $request->submit ) )
        {

// TODO - Needs to be improvised
            if ( $request->has( 'draw' ) && $request->draw )
            {
                $page      = $request->start == 0 ? 1 : ( $request->start / $request->length ) + 1;
                $page_size = $request->length;
            }
            else
            {
                $page      = 1;
                $page_size = 25;
            }

            $memos = $this->ApiObj->Get_CreditMemos( $request->customer, $request->sales_rep, $request->from_date, $request->to_date, $request->invoice_number, $request->po_number, $page, $page_size );
            $table = array( 'thead' => [
                'memo_number'    => 'Credit Number',
                'customer_id'    => 'Customer ID',
                'customer_po'    => 'Customer PO',
                'total_quantity' => 'Total Quantity',
                'total_amount'   => 'Total Amount',
                'status'         => 'Status',
                'actions'        => 'Actions'
            ], 'tbody' => [] );

            if ( isset( $memos['CreditMemos'] ) )
            {

                foreach ( $memos['CreditMemos'] as $memo )
                {
                    foreach($memo['Details'] as $index => $view)
                    {
                        $column = CommonController::get_selected_columns($view, [
                            'ImageName', 'ItemID', 'ItemDescription', 'OrderQuantity', 'InvoicedQuantity', 'Price'
                        ]);
                        $memo['Details'][$index] = $column;
                        $memo['Details'][$index]['Price'] = number_format($view['Price'], 2);
                    }
                        // echo print_r($memo,1);

                        $contents = [
                            'PO#'                   => $memo['CustomerPO'],
                            'Ref Invoice#'          => $memo['SalesInvoiceNo'],
                            'Customer ID'           => $memo['CustomerID'],
                            'Ship Via'              => $memo['ShipVia'],
                        ];

                        if(!empty($memo['RMANo'])){
                            $contents['RMA#'] = $memo['RMANo'];
                        }
                        if(!empty($memo['SalesRepID']) && Auth::user()->is_sale_rep){
                            $contents['Rep'] = $memo['SalesRepID'] . ' ' . Auth::user()->firstname . ' ' . Auth::user()->lastname;
                            $contents['Created By'] = Auth::user()->firstname . ' ' . Auth::user()->lastname;
                        }
                        if(!empty($memo['SpecialInstructions'])){
                            $contents['Special Instructions'] = $memo['SpecialInstructions'];
                        }
                        if(!empty($memo['Notes'])){
                            $contents['Notes'] = $memo['Notes'];
                        }

                    $bill_to_content = [
                        'First &LastName' => $memo['BillToAddress']['FirstName'] . ' ' . $memo['BillToAddress']['LastName'],
                        'StreetAddress1' => $memo['BillToAddress']['Address1']
                    ];

                    if (!empty($memo['BillToAddress']['Address2'])) {
                        $bill_to_content['StreetAddress2'] = $memo['BillToAddress']['Address1'];
                    }
                    $bill_to_content['City,State,Zip'] = $memo['BillToAddress']['City'] . ', ' . $memo['BillToAddress']['State']. ', ' . $memo['BillToAddress']['ZIP'];
                    $bill_to_content['Country'] = $memo['BillToAddress']['Country'];
                    $bill_to_content['PhoneNumber'] = $memo['BillToAddress']['Phone1'];
                    $bill_to_content['Email'] = $memo['BillToAddress']['Email'];

                    $ship_to_content = [
                        'First &LastName' => $memo['ShipToAddress']['FirstName'] . ' ' . $memo['ShipToAddress']['LastName'],
                        'StreetAddress1' => $memo['ShipToAddress']['Address1']
                    ];

                    if (!empty($memo['ShipToAddress']['Address2'])) {
                        $ship_to_content['StreetAddress2'] = $memo['ShipToAddress']['Address2'];
                    }
                    $ship_to_content['City,State,Zip'] = $memo['ShipToAddress']['State']. ', ' . $memo['ShipToAddress']['ZIP'];
                    $ship_to_content['Country'] = $memo['ShipToAddress']['Country'];
                    $ship_to_content['PhoneNumber'] = $memo['ShipToAddress']['Phone1'];
                    $ship_to_content['Email'] = $memo['ShipToAddress']['Email'];

                    $table['tbody'][] = [
                        'memo_number'    => isset( $memo['SalesInvoiceNo'] ) ? $memo['SalesInvoiceNo'] : 'N/A',
                        'customer_id'    => $memo['CustomerID'],
                        'customer_po'    => $memo['CustomerPO'],
                        'total_quantity' => isset( $memo['TotalQty'] ) ? $memo['TotalQty'] : 'N/A',
                        'total_amount'   => ConstantsController::CURRENCY.number_format( $memo['TotalAmount'], ConstantsController::ALLOWED_DECIMALS ),
                        'status'         => isset( $memo['Status'] ) ? $memo['Status'] : 'N/A',
                        'actions'        => [['type' => 'modal', 'label' => 'View Details']],
                        'details'        => [
                            'heading' => $memo['SalesInvoiceNo'].' : '.$memo['CustomerID'],
                            'body'    => [
                                'sections' => [
                                    [
                                        'title'   => $memo['CustomerID'].' '.$memo['CustomerName'],
                                        'content' => $contents,
                                        'cols'    => 6
                                    ],
                                    [
                                        'title'   => preg_replace('/([a-z])([A-Z])/', '$1 $2', $memo['TransactionType']) . '# '.$memo['TransactionNo'],
                                        'content' => [
                                            'Status'                => $memo['Status'],
                                            'Date'                  => Carbon::parse($memo['InvoiceDate'])->format('M-d-Y'),
                                            'Terms'                 => $memo['Terms'],
                                            'Total Quantity'        => $memo['TotalQty'],
                                            'Merchandise Amount'    => number_format($memo['TotalMerchandise'], 2),
                                            'Discount'              => $memo['Discount'],
                                            'Tax % and Amount'      => $memo['TaxRate']."%; ". number_format($memo['TaxAmount'], 2),
                                            'Other Charges'         => $memo['OtherCharges'],
                                            'Total Amount'          => $memo['TotalAmount'],
                                        ],
                                        'cols'                 => 6
                                    ],
                                    [
                                        'title'   => 'Bill To:',
                                        'content' => $bill_to_content,
                                        'hide_labels' => true,
                                        'cols'    => 6
                                    ],
                                    [
                                        'title'   => 'Ship To:',
                                        'content' => $ship_to_content,
                                        'hide_labels' => true,
                                        'cols'    => 6
                                    ],
                                    [
                                        'title'   => 'Details',
                                        'content' => $memo['Details'],
                                        'cols'    => 12
                                    ]
                                ]
                            ]
                        ]
                    ];
                }

                if ( $request->has( 'draw' ) && $request->draw )
                {
                    die( json_encode(
                        [
                            'recordsFiltered' => $memos['TotalRows'],
                            'recordsTotal'    => $memos['TotalRows'],
                            'draw'            => $request->draw + 1,
                            'data'            => $table['tbody']
                        ]
                    ) );
                }

            }

            $return['memos'] = $memos;
            $return['table'] = $table;
        }

        $filters = [
            [
                'title'       => 'Sales Rep',
                'type'        => 'hidden',
                'placeholder' => '',
                'value'       => Auth::user()->is_sale_rep ? Auth::user()->customer_id : ''
            ],
            [
                'title'       => 'From Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => $request->from_date ? $request->from_date : CommonController::get_date_format( '-1 month' )
            ],
            [
                'title'       => 'To Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => $request->to_date ? $request->to_date : CommonController::get_date_format( date( 'Y-m-d' ) )
            ],
            [
                'title'       => 'Customer',
                'type'        => Auth::user()->is_customer ? 'hidden' : 'select',
                'options'     => $this->get_customers_dropdown_options(),
                'placeholder' => '',
                'value'       => $request->has( 'customer' ) ? $request->customer : Auth::user()->customer_id
            ],
            [
                'title'       => 'PO Number',
                'type'        => 'text',
                'placeholder' => '',
                'attribues'   => ' maxlength="255" ',
                'value'       => $request->po_number
            ],
            [
                'title'       => 'Invoice Number',
                'type'        => 'number',
                'placeholder' => '',
                'attribues'   => ' maxlength="255" ',
                'value'       => $request->invoice_number
            ]
        ];

        $return['filters'] = $filters;
        return $return;
    }

    // TODO : The dashboard for the LR needs to have the icons.
    public function get_debit_memos( Request $request )
    {

        $return = ['memos' => [], 'table' => [], 'filters' => []];

        if ( count( $request->all() ) > 0 && isset( $request->submit ) )
        {
            $memos = $this->ApiObj->Get_DebitMemos( $request->from_date, $request->to_date, $request->invoice_number, Auth::user()->customer_id );
            $table = array( 'thead' => [
                'memo_number'    => 'Memo Number',
                'vendor'         => 'Vendor ID',
                'total_quantity' => 'Total Quantity',
                'total_amount'   => 'Total Amount',
                'status'         => 'Status',
                'actions'        => 'Actions'
            ], 'tbody' => [] );

            if ( isset( $memos['DebitMemos'] ) )
            {

                foreach ( $memos['DebitMemos'] as $memo )
                {
                    $table['tbody'][] = [
                        'memo_number'    => $memo['PayableInvoiceNo'] ?? 'N/A',
                        'vendor'         => $memo['VendorID'],
                        'total_quantity' => $memo['TotalQty'] ?? 'N/A',
                        'total_amount'   => ConstantsController::CURRENCY.number_format( $memo['TotalAmount'], ConstantsController::ALLOWED_DECIMALS ),
                        'status'         => $memo['Status'] ?? 'N/A',
                        'actions'        => [['type' => 'modal', 'label' => 'View Details']],
                        'details'        => [
                            // 'heading' => $memo['PayableInvoiceNo'].' : '.$memo['CustomerID'],
                            'heading' => $memo['PayableInvoiceNo'],
                            'body'    => [
                                'sections' => [
                                    [
                                        'title'   => 'General',
                                        'content' => [
                                            'Invoice Number'   => $memo['PayableInvoiceNo'],
                                            // 'Customer ID'      => $memo['CustomerID'],
                                            'Vendor ID'        => $memo['VendorID'],
                                            'Sales Order #'    => $memo['SalesOrderNo'],
                                            'Total Amount'     => number_format($memo['TotalAmount'], 2),
                                            'Payment Due Date' => CommonController::get_date_format( $memo['PaymentDueDate'] )
                                        ],
                                        'cols' => 6
                                    ],
                                    [
                                        'title'   => 'Billing Details',
                                        'content' => $memo['BillToAddress'],
                                        'cols' => 6,
                                        'hide_labels' => 1
                                    ],
                                    [
                                        'title'   => 'Details',
                                        'content' => $memo['Details'],
                                        'cols' => 12
                                    ]
                                ]
                            ]
                        ]
                    ];
                }

            }

            $return['memos'] = $memos;
            $return['table'] = $table;
        }

        $filters = [
            [
                'title'       => 'Sales Rep',
                'type'        => 'hidden',
                'placeholder' => '',
                'value'       => Auth::user()->is_sale_rep ? Auth::user()->customer_id : ''
            ],
            [
                'title'       => 'From Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => $request->from_date ? $request->from_date : CommonController::get_date_format( '-1 month' )
            ],
            [
                'title'       => 'To Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => $request->to_date ? $request->to_date : CommonController::get_date_format( date( 'Y-m-d' ) )
            ],
            [
                'title'       => 'Customer',
                'type'        => Auth::user()->is_customer ? 'hidden' : 'select',
                'options'     => $this->get_customers_dropdown_options(),
                'placeholder' => '',
                'value'       => $request->has( 'customer' ) ? $request->customer : Auth::user()->customer_id
            ],
            [
                'title'       => 'Vendor',
                'type'        => 'text',
                'placeholder' => '',
                'value'       => $request->vendor
            ],
            [
                'title'       => 'Invoice Number',
                'type'        => 'number',
                'placeholder' => '',
                'attribues'   => ' maxlength="255" ',
                'value'       => $request->invoice_number
            ]
        ];

        $return['filters'] = $filters;

        return $return;
    }

    public function get_invoices( Request $request )
    {

        $return = ['invoices' => [], 'table' => [], 'filters' => []];

        if ( count( $request->all() ) > 0 )
        {

// TODO - Needs to be improvised
            if ( $request->has( 'draw' ) && $request->draw )
            {
                $page      = $request->start == 0 ? 1 : ( $request->start / $request->length ) + 1;
                $page_size = $request->length;
            }
            else
            {
                $page      = 1;
                $page_size = 25;
            }

            $invoices = $this->ApiObj->Get_Invoices( $request->customer, $request->sales_rep, $request->invoice_number, $request->po_number, $request->from_date, $request->to_date, $page, $page_size );
            $table    = array( 'thead' => [
                'invoice_no'     => 'Sale Invoice Number',
                'invoice_date'   => 'Sale Invoice Date',
                'customer_id'    => 'Customer ID',
                'total_quantity' => 'Total Quantity',
                'total_amount'   => 'Total Amount',
                'status'         => 'Status',
                'actions'        => 'Actions'
            ], 'tbody' => [] );

            if ( isset( $invoices['SalesInvoices'] ) )
            {

                foreach ( $invoices['SalesInvoices'] as $invoice )
                {

                    foreach($invoice['Details'] as $index => $view)
                    {
                        $column = CommonController::get_selected_columns($view, [
                            'ImageName', 'ItemID', 'LineNo', 'ItemDescription', 'OrderQuantity', 'InvoicedQuantity', 'Price', 'ExtPrice', 'OpenQuantity'
                        ]);
                        $invoice['Details'][$index] = $column;
                        $invoice['Details'][$index]['Price'] = number_format($view['Price'], 2);
                        $invoice['Details'][$index]['ExtPrice'] = number_format($view['ExtPrice'], 2);
                    }

                    foreach($invoice['OrderTrackingDetail'] as $index => $view)
                    {
                        $column = CommonController::get_selected_columns($view, [
                            'ImageName', 'ItemID', 'SalesOrderNo', 'DateCreated', 'SalesInvoiceNo', 'TrackingNo'
                        ]);
                        $column['DateCreated'] = Carbon::parse($column['DateCreated'])->format('M-d-Y');
                        $invoice['OrderTrackingDetail'][$index] = $column;
                    }

                    $customer_content = [
                        'PO#' => $invoice['CustomerPO'],
                        'SO#' => $invoice['SalesOrderNo'],
                        'OrderPlacedBy' => $invoice['OrderPlacedBy']
                    ];

                    if (!empty($invoice['SalesRepID']) && Auth::user()->is_sale_rep) {
                        $customer_content['Rep'] = $invoice['SalesRepID'] . ' ' . Auth::user()->firstname . ' ' . Auth::user()->lastname;
                    }

                    if (!empty($invoice['ShipVia'])) {
                        $customer_content['ShipVia'] = $invoice['ShipVia'];
                    }

                    if (!empty($invoice['SpecialInstructions'])) {
                        $customer_content['SpecialInstructions'] = $invoice['SpecialInstructions'];
                    }

                    if (!empty($invoice['Notes'])) {
                        $customer_content['Notes'] = $invoice['Notes'];
                    }

                    $bill_to_details = [
                        'name' => $invoice['BillToAddress']['FirstName'] . ($invoice['BillToAddress']['LastName'] ? ' ' . $invoice['BillToAddress']['LastName'] : ''),
                        'address1' => $invoice['BillToAddress']['Address1'],
                        'address2' => $invoice['BillToAddress']['Address2'] !== 'N/A' && $invoice['BillToAddress']['Address2'] ? $invoice['BillToAddress']['Address2'] : '',
                        'city_address' => $invoice['BillToAddress']['City'] . ', ' . $invoice['BillToAddress']['State'] . ' ' .$invoice['BillToAddress']['ZIP'],
                        'country' => $invoice['BillToAddress']['Country'],
                        'phone' => $invoice['BillToAddress']['Phone1'] ? $invoice['BillToAddress']['Phone1'] : ''
                    ];

                    $ship_to_details = [
                        'name' => $invoice['ShipToAddress']['FirstName'] . ($invoice['ShipToAddress']['LastName'] ? ' ' . $invoice['ShipToAddress']['LastName'] : ''),
                        'address1' => $invoice['ShipToAddress']['Address1'],
                        'address2' => $invoice['ShipToAddress']['Address2'] !== 'N/A' && $invoice['ShipToAddress']['Address2'] ? $invoice['ShipToAddress']['Address2'] : '',
                        'city_address' => $invoice['ShipToAddress']['City'] . ', ' . $invoice['ShipToAddress']['State'] . ' ' .$invoice['ShipToAddress']['ZIP'],
                        'country' => $invoice['ShipToAddress']['Country'],
                        'phone' => $invoice['ShipToAddress']['Phone1'] ? $invoice['ShipToAddress']['Phone1'] : ''
                    ];

                    $table['tbody'][] = [
                        'invoice_no'     => $invoice['SalesInvoiceNo'],
                        'invoice_date'   => CommonController::get_date_format( $invoice['InvoiceDate'] ),
                        'customer_id'    => $invoice['CustomerID'],
                        'total_quantity' => isset( $invoice['TotalQty'] ) ? $invoice['TotalQty'] : 'N/A',
                        'total_amount'   => ConstantsController::CURRENCY.number_format( $invoice['TotalAmount'], ConstantsController::ALLOWED_DECIMALS ),
                        'status'         => isset( $invoice['Status'] ) ? $invoice['Status'] : 'N/A',
                        'actions'        => [['type' => 'modal', 'label' => 'View Details']],
                        'details'        => [
                            'heading' => $invoice['SalesInvoiceNo'].' : '.$invoice['CustomerID'],
                            'body'    => [
                                'sections' => [
                                    [
                                        'title'   => $invoice['CustomerID'] . ' ' . $invoice['CustomerName'],
                                        'content' => $customer_content,
                                        'cols'    => 6
                                    ],
                                    [
                                        'title'   => 'Sales Invoice#: ' . $invoice['TransactionNo'],
                                        'content' => [
                                            'Status ' => $invoice['Status'],
                                            'Date ' => Carbon::parse($invoice['InvoiceDate'])->format('M-d-Y'),
                                            'Terms' => $invoice['Terms'],
                                            'TotalQty' => $invoice['TotalQty'],
                                            'MerchandiseAmount' => number_format($invoice['TotalMerchandise'], ConstantsController::ALLOWED_DECIMALS),
                                            'Discount' => ($invoice['Discount'] == 'N/A' ? number_format("0.00", ConstantsController::ALLOWED_DECIMALS) : $invoice['Discount']),
                                            'Tax % &Amount' => number_format( $invoice['TaxRate'], ConstantsController::ALLOWED_DECIMALS ) . '%; ' . number_format($invoice['TaxAmount'], ConstantsController::ALLOWED_DECIMALS),
                                            'Shipping &Handling' => number_format($invoice['ShippingCharges'] + $invoice['HandlingCharges'], ConstantsController::ALLOWED_DECIMALS),
                                            'TotalAmount' => number_format($invoice['TotalAmount'], ConstantsController::ALLOWED_DECIMALS),
                                        ],
                                        'cols' => 6
                                    ],
                                    [
                                        'title'   => 'Bill To',
                                        'content' => $bill_to_details,
                                        'hide_labels' => true,
                                        'cols' => 6
                                    ],
                                    [
                                        'title'   => 'Ship To',
                                        'content' => $ship_to_details,
                                        'hide_labels' => true,
                                        'cols' => 6
                                    ],
                                    [
                                        'title'   => 'Details',
                                        'cols' => 12,
                                        'content' => isset( $invoice['OrderTrackingDetail'] ) ? [
                                            'tabs' => [
                                                'products' => $invoice['Details'],
                                                'tracks'   => isset( $invoice['OrderTrackingDetail'] ) ? $invoice['OrderTrackingDetail'] : []
                                            ]
                                        ] : $invoice['Details']
                                    ]
                                ]
                            ]
                        ]
                    ];
                }

                if ( $request->has( 'draw' ) && $request->draw )
                {
                    die( json_encode(
                        [
                            'recordsFiltered' => $invoices['TotalRows'],
                            'recordsTotal'    => $invoices['TotalRows'],
                            'draw'            => $request->draw + 1,
                            'data'            => $table['tbody']
                        ]
                    ) );
                }

            }

            $return['invoices'] = $invoices;
            $return['table']    = $table;
        }

        $filters = [
            [
                'title'       => 'Sales Rep',
                'type'        => 'hidden',
                'placeholder' => '',
                'value'       => Auth::user()->is_sale_rep ? Auth::user()->customer_id : ''
            ],
            [
                'title'       => 'From Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => $request->from_date ? $request->from_date : CommonController::get_date_format( '-1 month' )
            ],
            [
                'title'       => 'To Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => $request->to_date ? $request->to_date : CommonController::get_date_format( date( 'Y-m-d' ) )
            ],
            [
                'title'       => 'Customer',
                'type'        => Auth::user()->is_customer ? 'hidden' : 'select',
                'options'     => $this->get_customers_dropdown_options(),
                'placeholder' => '',
                'value'       => $request->has( 'customer' ) ? $request->customer : Auth::user()->customer_id
            ],
            [
                'title'       => 'PO Number',
                'type'        => 'text',
                'placeholder' => '',
                'attribues'   => ' maxlength="255" ',
                'value'       => $request->po_number
            ],
            [
                'title'       => 'Invoice Number',
                'type'        => 'number',
                'placeholder' => '',
                'attribues'   => ' maxlength="255" ',
                'value'       => $request->invoice_number
            ]
        ];

        $return['filters'] = $filters;

        return $return;
    }

    public function invoice( Request $request )
    {
        $data = $this->get_invoices( $request );
        View::share( 'invoices', $data['invoices'] );
        View::share( 'table', $data['table'] );
        View::share( 'filters', $data['filters'] );
        View::share( 'paginated', 'yes' );

        View::share( 'title', 'Invoices' );

        return view( 'dashboard.generic-report' );
    }

    public function payment_options()
    {
        return view( 'dashboard.payment-options' );
    }

    public function view_order( Request $request )
    {

        if ( count( $request->all() ) > 0 )
        {

// TODO - Needs to be improvised
            if ( $request->has( 'draw' ) && $request->draw )
            {
                $page      = $request->start == 0 ? 1 : ( $request->start / $request->length ) + 1;
                $page_size = $request->length;
            }
            else
            {
                $page      = 1;
                $page_size = 25;
            }

            $view_orders = $this->ApiObj->View_Order( $request->customer, $request->external_number, $request->from_date, $request->to_date, $request->sales_rep, $page, $page_size, $request->status );
            $table       = array( 'thead' => [
                'order_no'     => 'Order Number',
                'customer_id'  => 'Customer ID',
                'customer_po'  => 'Customer PO',
                'total_Amount' => 'Total Amount',
                'total_qty'    => 'Total Quantity',
                'status'       => 'Status',
                'order_date'   => 'Order Date',
                'actions'      => 'Actions',
            ], 'tbody' => [] );

            if ( isset( $view_orders['Orders'] ) )
            {

                foreach ( $view_orders['Orders'] as $view_order )
                {
                    if ( isset($this->active_theme_json->theme_slug) && $this->active_theme_json->theme_slug === 'lr' )
                    {
                        foreach($view_order['Detail'] as $index => $view)
                        {
                            $column = CommonController::get_selected_columns($view, [
                                'ImageName', 'ItemID', 'ItemDescription', 'UnitPrice', 'OrderQty', 'Status', 'ShippedQty', 'ExtPrice', 'SideMark'
                            ]);
                            $column['href'] = route('frontend.item', [$view['Collection'], $view['DesignID']]);
                            $column['BackOrderQty'] = isset($view['BackOrder']) && CommonController::check_bit_field($view, 'BackOrder' ) ? ( (isset($view['ETADate']) ? $view['ETADate'] : '') . (isset($view['ETAQty']) ? $view['ETAQty'] : '')) : '';
                            $view_order['Detail'][$index] = $column;
                            $view_order['Detail'][$index]['UnitPrice'] = number_format($view['UnitPrice'], 2);
                            $view_order['Detail'][$index]['ExtPrice'] = number_format($view['ExtPrice'], 2);
                        }

                        foreach($view_order['OrderTrackingDetail'] as $index => $view)
                        {
                            $column = CommonController::get_selected_columns($view, [
                                'ImageName', 'ItemID', 'SalesOrderNo', 'DateCreated', 'SalesInvoiceNo', 'TrackingNo'
                            ]);
                            $column['DateCreated'] = Carbon::parse($column['DateCreated'])->format('M-d-Y');
                            $view_order['OrderTrackingDetail'][$index] = $column;
                        }

                        foreach ($view_order['OrderInvoiceDetail'] as $index => $view) {
                            $view_order['OrderInvoiceDetail'][$index]['InvoiceDate'] = Carbon::parse($view['InvoiceDate'])->format('M-d-Y');
                            $view_order['OrderInvoiceDetail'][$index]['TotalAmount'] = number_format($view['TotalAmount'], 2);
                        }
                    }

                    $customer_content =  [
                        'PO#'   => $view_order['Header']['CustomerPO'],
                        'ShipVia'       => $view_order['Header']['ShipViaCode'],
                        'OrderPlacedBy'   => $view_order['Header']['OrderTakenBy']
                    ];

                    if (!empty($view_order['Header']['SalesRepID']) && Auth::user()->is_sale_rep) {
                        $customer_content['Rep'] = $view_order['Header']['SalesRepID'] . ' ' . Auth::user()->firstname . ' ' . Auth::user()->lastname;
                    }

                    if (!empty($view_order['Header']['SalesRepID'])) {
                        $customer_content['SpecialInstructions'] = $view_order['Header']['SpecialInstructions'];
                    }

                    if (!empty($view_order['Header']['SalesRepID'])) {
                        $customer_content['Notes'] = $view_order['Header']['Instructions'];
                    }

                    $bill_to_content = [
                        'First &LastName' => $view_order['Header']['BillingFirstName'] . ' ' . $view_order['Header']['BillingLastName'],
                        'StreetAddress1' => $view_order['Header']['BillingFirstName']
                    ];

                    if (!empty($view_order['Header']['BillingAddress2'])) {
                        $bill_to_content['StreetAddress2'] = $view_order['Header']['BillingAddress1'];
                    }
                    $bill_to_content['City,State,Zip'] = $view_order['Header']['BillingCity'] . ', ' . $view_order['Header']['BillingState']. ', ' . $view_order['Header']['BillingZipCode'];
                    $bill_to_content['Country'] = $view_order['Header']['BillingCountry'];
                    $bill_to_content['PhoneNumber'] = $view_order['Header']['BillingPhone1'];
                    $bill_to_content['Email'] = $view_order['Header']['BillingEmail'];

                    $ship_to_content = [
                        'First &LastName' => $view_order['Header']['ShippingFirstName'] . ' ' . $view_order['Header']['ShippingLastName'],
                        'StreetAddress1' => $view_order['Header']['ShippingAddress1']
                    ];

                    if (!empty($view_order['Header']['ShippingAddress2'])) {
                        $ship_to_content['StreetAddress2'] = $view_order['Header']['ShippingAddress2'];
                    }
                    $ship_to_content['City,State,Zip'] = $view_order['Header']['ShippingState']. ', ' . $view_order['Header']['ShippingZipCode'];
                    $ship_to_content['Country'] = $view_order['Header']['ShippingCountry'];
                    $ship_to_content['PhoneNumber'] = $view_order['Header']['ShippingPhone'];
                    $ship_to_content['Email'] = $view_order['Header']['ShippingEmail'];

                    $table['tbody'][] = [
                        'order_no'     => $view_order['Header']['OrderNo'],
                        'customer_id'  => $view_order['Header']['CustomerID'],
                        'customer_po'  => $view_order['Header']['CustomerPO'],
                        'total_Amount' => ConstantsController::CURRENCY.number_format( $view_order['Header']['TotalAmount'], ConstantsController::ALLOWED_DECIMALS ),
                        'total_qty'    => $view_order['Header']['TotalQty'],
                        'status'       => $view_order['Header']['Status'],
                        'tab'          => isset( $view_order['Header']['TabStatusDescription'] ) ? $view_order['Header']['TabStatusDescription'] : '',
                        'order_date'   => isset( $view_order['Header']['OrderDate'] ) ? CommonController::get_date_format( $view_order['Header']['OrderDate'] ) : 'N/A',
                        'actions'      => [['type' => 'modal', 'label' => 'View Details']],
                        'details'      => [
                            'heading' => $view_order['Header']['OrderNo'].' : '.$view_order['Header']['CustomerID'],
                            'body'    => [
                                'sections' => [
                                    [
                                        'title'   => $view_order['Header']['CustomerID'] . ' ' . $view_order['Header']['CustomerName'],
                                        'content' => $customer_content,
                                        'cols' => 6
                                    ],
                                    [
                                        'title'   => preg_replace('/([a-z])([A-Z])/', '$1 $2', $view_order['Header']['TransactionType']) . '#: ' . $view_order['Header']['TransactionNo'],
                                        'content' => [
                                            'Status ' => $view_order['Header']['Status'],
                                            'OrderDate ' => Carbon::parse($view_order['Header']['OrderDate'])->format('M d, Y'),
                                            'ShipDate' => Carbon::parse($view_order['Header']['ShippingDate'])->format('M d, Y'),
                                            'Terms' => $view_order['Header']['PaymentTerm'],
                                            'TotalQty' => $view_order['Header']['TotalQty'],
                                            'MerchandiseTotal' => number_format(floatval($view_order['Header']['TotalMerchandise']), 2)
                                        ],
                                        'cols' => 6
                                    ],
                                    [
                                        'title'   => 'Bill To:',
                                        'content' => $bill_to_content,
                                        'cols' => 6,
                                        'hide_labels' => 1
                                    ],
                                    [
                                        'title'   => 'Ship To: ',
                                        'content' => $ship_to_content,
                                        'cols' => 6,
                                        'hide_labels' => 1
                                    ],
                                    [
                                        'title'   => 'Detail',
                                        'cols' => 12,
                                        'content' => isset( $view_order['Header']['TabStatusDescription'] ) ? [
                                            'tabs' => [
                                                'products' => $view_order['Detail'],
                                                'tracks'   => isset( $view_order['OrderTrackingDetail'] ) ? $view_order['OrderTrackingDetail'] : [],
                                                'invoices' => isset( $view_order['OrderInvoiceDetail'] ) ? $view_order['OrderInvoiceDetail'] : []
                                            ]
                                        ] : $view_order['Detail']
                                    ]
                                ]
                            ]
                        ]
                    ];
                }

                if ( $request->has( 'draw' ) && $request->draw )
                {
                    return response()->json(
                        [
                            'recordsFiltered' => $view_orders['TotalRows'],
                            'recordsTotal'    => $view_orders['TotalRows'],
                            'draw'            => $request->draw + 1,
                            'data'            => $table['tbody']
                        ]
                    );
                }

            }

            View::share( 'view_orders', $view_orders );
            View::share( 'table', $table );
        }

        $filters = [
            [
                'title'       => 'Sales Rep',
                'type'        => 'hidden',
                'placeholder' => '',
                'value'       => Auth::user()->is_sale_rep ? Auth::user()->customer_id : ''
            ],
            [
                'title'       => 'From Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => $request->from_date ? $request->from_date : CommonController::get_date_format( '-1 month' )
            ],
            [
                'title'       => 'To Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => $request->to_date ? $request->to_date : CommonController::get_date_format( date( 'Y-m-d' ) )
            ],
            [
                'title'       => 'Customer',
                'type'        => Auth::user()->is_customer ? 'hidden' : 'select',
                'options'     => $this->get_customers_dropdown_options(),
                'placeholder' => '',
                'value'       => $request->has( 'customer' ) ? $request->customer : Auth::user()->customer_id
            ],
            [
                'title'       => 'External Number',
                'type'        => 'hidden',
                'placeholder' => '',
                'value'       => $request->external_number
            ],
            [
                'title'       => 'Status',
                'type'        => 'select',
                'options'     => $this->sales_order_statuses,
                'placeholder' => '',
                'value'       => $request->status ? $request->status : ''
            ]
        ];

        View::share( 'filters', $filters );
        View::share( 'status', $this->sales_order_statuses );
        View::share( 'title', 'Orders' );
        View::share( 'paginated', 'yes' );
        View::share( 'tabular', isset( $this->active_theme_json->general->tabular_orders ) && $this->active_theme_json->general->tabular_orders ? 'yes' : 'no' );

        return view( 'dashboard.generic-report' );
    }

    public function view_return( Request $request )
    {

        if ( count( $request->all() ) > 0 )
        {

// TODO - Needs to be improvised
            if ( $request->has( 'draw' ) && $request->draw )
            {
                $page      = $request->start == 0 ? 1 : ( $request->start / $request->length ) + 1;
                $page_size = $request->length;
            }
            else
            {
                $page      = 1;
                $page_size = 25;
            }

            $rmas = $this->ApiObj->Get_View_Return( $request->customer, $request->sales_rep, $request->from_date, $request->to_date, $request->rma_number, $request->invoice_number, $request->packing_slip_number, $request->order_number, $page, $page_size );

            $table = array( 'thead' => [
                'rma_no'                 => 'RMA Number',
                'customer_return_number' => 'Customer Return #',
                'credit_memo_number'     => 'Credit Memo #',
                'return_date'            => 'Return Date',
                'quantity'               => 'Quantity',
                'amount'                 => 'Amount',
                'status'                 => 'Status',
                'actions'                => 'Actions'
            ], 'tbody' => [] );

            if ( isset( $rmas['RMAs'] ) )
            {

                foreach ( $rmas['RMAs'] as $rma )
                {

                    foreach($rma['Details'] as $index => $view)
                    {
                        $column = CommonController::get_selected_columns($view, [
                            'ImageName', 'ItemID', 'LineNo', 'UPC', 'SKU', 'ItemDescription', 'Price'
                        ]);
                        $rma['Details'][$index] = $column;
                    }

                    $table['tbody'][] = [
                        'rma_no'                 => $rma['RMANo'],
                        'customer_return_number' => isset( $rma['CustomerReturnNo'] ) ? $rma['CustomerReturnNo'] : 'N/A',
                        'credit_memo_number'     => isset( $rma['CreditMemoNo'] ) ? $rma['CreditMemoNo'] : 'N/A',
                        'return_date'            => isset( $rma['RMADate'] ) ? CommonController::get_date_format( $rma['RMADate'] ) : 'N/A',
                        'quantity'               => $rma['TotalQuantity'],
                        'amount'                 => ConstantsController::CURRENCY.number_format( $rma['TotalAmount'], ConstantsController::ALLOWED_DECIMALS ),
                        'status'                 => isset( $rma['Status'] ) ? $rma['Status'] : 'N/A',
                        'actions'                => [['type' => 'modal', 'label' => 'View Details']],
                        'details'                => [
                            'heading' => $rma['RMANo'].' : '.$rma['CustomerID'],
                            'body'    => [
                                'sections' => [
                                    [
                                        'title'   => 'General',
                                        'content' => [
                                            'Rma Number'    => $rma['RMANo'],
                                            'Customer ID'   => $rma['CustomerID'],
                                            'Customer Name' => $rma['CustomerName'],
                                            'Sales Order #' => $rma['SalesOrderNo'],
                                            'Total Amount'  => ConstantsController::CURRENCY.number_format( $rma['TotalAmount'], ConstantsController::ALLOWED_DECIMALS )
                                        ]
                                    ],

                                    [
                                        'title'   => 'Details',
                                        'content' => $rma['Details']
                                    ]

                                ]
                            ]
                        ]
                    ];
                }

                if ( $request->has( 'draw' ) && $request->draw )
                {
                    return response()->json(
                        [
                            'recordsFiltered' => $rmas['TotalRows'],
                            'recordsTotal'    => $rmas['TotalRows'],
                            'draw'            => $request->draw + 1,
                            'data'            => $table['tbody']
                        ]
                    );
                }

            }

            View::share( 'rmas', $rmas );
            View::share( 'table', $table );
        }

        $filters = [
            [
                'title'       => 'Sales Rep',
                'type'        => 'hidden',
                'placeholder' => '',
                'value'       => Auth::user()->is_sale_rep ? Auth::user()->customer_id : ''
            ],
            [
                'title'       => 'RMA Number',
                'type'        => 'number',
                'placeholder' => '',
                'attribues'   => ' maxlength="255" ',
                'value'       => $request->rma_number
            ],

            [
                'title'       => 'Invoice Number',
                'type'        => 'number',
                'placeholder' => '',
                'attribues'   => ' maxlength="255" ',
                'value'       => $request->invoice_number
            ],
            [
                'title'       => 'Packing Slip Number',
                'type'        => 'number',
                'placeholder' => '',
                'attribues'   => ' maxlength="255" ',
                'value'       => $request->packing_slip_number
            ],

            [
                'title'       => 'Order Number',
                'type'        => 'number',
                'placeholder' => '',
                'attribues'   => ' maxlength="255" ',
                'value'       => $request->order_number
            ],
            [
                'title'       => 'Customer',
                'type'        => Auth::user()->is_customer ? 'hidden' : 'select',
                'options'     => $this->get_customers_dropdown_options(),
                'placeholder' => '',
                'value'       => $request->has( 'customer' ) ? $request->customer : Auth::user()->customer_id
            ],
            [
                'title'       => 'From Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => $request->from_date ? $request->from_date : CommonController::get_date_format( '-1 month' )
            ],
            [
                'title'       => 'To Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => $request->to_date ? $request->to_date : CommonController::get_date_format( date( 'Y-m-d' ) )
            ]

        ];

        View::share( 'filters', $filters );
        View::share( 'title', 'Returns' );
        View::share( 'paginated', 'yes' );

        return view( 'dashboard.generic-report' );
    }

}
