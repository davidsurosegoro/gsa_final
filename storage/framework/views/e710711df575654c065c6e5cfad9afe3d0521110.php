

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-6">
    <div class="card card-custom">
      <div class="card-body">
      <form action="" class="form">
        <?php echo e(csrf_field()); ?>

        <textarea  id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target">

        </textarea>
      </form>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card card-custom">
      <div class="card-header">
        <h3 class="card-title">Preview Dokumen</h3>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script src="<?php echo e(asset('assets/plugins/custom/tinymce/tinymce.bundle.js')); ?>"></script>
<script>
  var KTTinymce = function () {
                                // Private functions
                                var demos = function () {
                                    tinymce.init({
                                        selector: '#kt-tinymce-4',
                                        menubar: false,
                                        toolbar: ['styleselect fontselect fontsizeselect',
                                            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
                                            'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'],
                                        plugins : 'advlist autolink link image lists charmap print preview code'
                                    });
                                }

                                return {
                                    // public functions
                                    init: function() {
                                        demos();
                                    }
                                };
                            }();

                            // Initialization
                            jQuery(document).ready(function() {
                                KTTinymce.init();
                            });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/editor.blade.php ENDPATH**/ ?>