<?php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;
?>

<?php $__env->startSection('title','Dashboard | Company Credit'); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper admin-side">
   <?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <main class="main-content">
      <section class="collection-section">
         <div class="container">
            <div class="d-flex flex-row">
               <div class="col-lg-3 col-sm-6 col-6 sidebar-main">
                  <?php echo $__env->make('dashboard.components.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               </div>
               <div class="col-xl-9 col-lg-12 col-sm-12 col-12 py-0">
                  <div class="card mt-4 p-4">
                     <h3 class="font-ropa">
                        <span>Company Credit</span>
                     </h3>
                     <div class="row font-ropa">
                        <form class="row credit-details">
                           <div class="col-md-6 mb-5">
                              <label class="text-lg">Active Customer: </label>
                              <select name="customer" class="form-control">
                                 <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($customer['value']); ?>" <?php echo e($active_customer && $active_customer == $customer['value'] ? 'selected' : ''); ?>>
                                    <?php echo e($customer['label']); ?>

                                 </option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                        </form>
                        <div class="col-md-12">
                           <label class=" text-lg">Net Terms: </label>
                           <span class=" text-lg"><?php echo e($company_credit['PaymentTerms']); ?></span>
                        </div>
                        <div class="p-0 col-md-4 mt-2">
                           <label class="col-md-12">Outstanding Balance</label>
                           <span class="col-md-12 text-lg"><?php echo e($company_credit['OutstandingBalance'] === 'N/A' ? $company_credit['OutstandingBalance'] : ConstantsController::CURRENCY . number_format($company_credit['OutstandingBalance'], ConstantsController::ALLOWED_DECIMALS)); ?></span>
                        </div>
                        <div class="p-0 col-md-4 mt-2">
                           <label class="col-md-12">Available Credit</label>
                           <span class="col-md-12 text-lg"><?php echo e($company_credit['AvailableCredit'] === 'N/A' ? $company_credit['AvailableCredit'] : ConstantsController::CURRENCY . number_format($company_credit['AvailableCredit'], ConstantsController::ALLOWED_DECIMALS)); ?></span>
                        </div>
                        <div class="p-0 col-md-4 mt-2">
                           <label class="col-md-12">Credit Limit</label>
                           <span class="col-md-12 text-lg"><?php echo e($company_credit['CreditLimit'] === 'N/A' ? $company_credit['CreditLimit'] : ConstantsController::CURRENCY . number_format($company_credit['CreditLimit'], ConstantsController::ALLOWED_DECIMALS)); ?></span>
                        </div>
                     </div>
                     <div class="row mt-5 d-none">
                        <div class="d-flex flex-row flex-md-wrap flex-sm-wrap justify-content-between">
                           <a style="text-decoration: none;" href="<?php echo e(route('dashboard.companycredit', ['rtype' => 'credit-memos', 'customer' => $active_customer])); ?>" class="col-md-3 card text-white bg-danger mb-3">
                              <div class="align-items-center card-body d-flex justify-content-between p-1 text-center">
                                 <h5 class="font-ropa m-0">Credit Memos</h5>
                                 <i class="bi bi-chevron-right d-none lr-theme-only"></i>
                              </div>
                           </a>
                           <?php if(Auth::user()->is_sale_rep): ?>
                           <a style="text-decoration: none;" href="<?php echo e(route('dashboard.companycredit', ['rtype' => 'debit-memos', 'customer' => $active_customer])); ?>" class="col-md-3 card text-white bg-danger mb-3">
                              <div class="align-items-center card-body d-flex justify-content-between p-1 text-center">
                                 <h5 class="font-ropa m-0">Debit Memos</h5>
                                 <i class="bi bi-chevron-right d-none lr-theme-only"></i>
                              </div>
                           </a>
                           <?php endif; ?>
                           <a style="text-decoration: none;" href="<?php echo e(route('dashboard.companycredit', ['rtype' => 'invoices', 'customer' => $active_customer])); ?>" class="col-md-3 card text-white bg-danger mb-3">
                              <div class="align-items-center card-body d-flex justify-content-between p-1 text-center">
                                 <h5 class="font-ropa m-0">Invoices</h5>
                                 <i class="bi bi-chevron-right d-none lr-theme-only"></i>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
                  <?php if(isset($additional_data)): ?>
                  <div class="account-content p-5 mt-5 company-credit-type">
                     <!-- <h1 class="section-title text-center mb-3 font-ropa d-none lr-theme-only"><?php echo e($additional_data['title']); ?></h1> -->
                     <?php echo $__env->make('dashboard.components.filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     <div class="table-container col-md-12">
                        <?php if(isset($memos['CreditMemos']) OR isset($memos['DebitMemos']) OR isset($transactions['FinancialTransactions']) OR isset($invoices['SalesInvoices']) OR isset($rmas['RMAs']) OR isset($view_orders['Orders'])): ?>
                        <?php echo $__env->make('dashboard.components.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php elseif(strstr($_SERVER['REQUEST_URI'], "?") && isset($_REQUEST['submit'])): ?>
                        <h4 class="font-ropa">Data not available.</h4>
                        <?php endif; ?>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </section>
   </main>
   <?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
   $(document).ready(function() {
      $('form.credit-details select[name="customer"]').on('change', function() {
         $(this).closest('form').submit();
      });

      $('[name="report_type"]').change(function(){
         if ( $(this).val() == 'debit-memos' ) {
            var parent = $('[name="po_number"]').parent();
            $('input', parent).attr('name', 'vendor');
            $('label', parent).html('Vendor').attr('for', 'vendor');
         } else {
            var parent = $('[name="vendor"]').parent();
            $('input', parent).attr('name', 'po_number');
            $('label', parent).html('PO Number').attr('for', 'po_number');
         }
      });
   });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\lrhome\resources\views/dashboard/company-credit.blade.php ENDPATH**/ ?>