<div class="modal modal-sticky modal-sticky-bottom-center modal-setting" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-diagonal bg-diagonal-primary bg-diagonal-r-light">
                <h5 class="modal-title text-white" style="z-index: 1;">
                    <i class="fas fa-palette text-white icon-lg"> </i> Styling dan Analisa Layer
                </h5>
                <button class="close" type="button" data-dismiss="modal">
                    <i aria-hidden="true" class="ki ki-close">
                    </i>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs nav-tabs-line mb-5">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#style_tab">
                            <span class="nav-icon">
                                <i class="flaticon2-contract">
                                </i>
                            </span>
                            <span class="nav-text">
                                Styling Peta
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#analisa_query_tab">
                            <span class="nav-icon">
                                <i class="flaticon-presentation">
                                </i>
                            </span>
                            <span class="nav-text">
                                Analisa Query
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#analisa_buffer_tab">
                            <span class="nav-icon">
                                <i class="flaticon-placeholder">
                                </i>
                            </span>
                            <span class="nav-text">
                                Analisa Buffer
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#filter_peta_tab">
                            <span class="nav-icon">
                                <i class="flaticon2-layers-2">
                                </i>
                            </span>
                            <span class="nav-text">
                                Filter Peta
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tentang_peta_tab">
                            <span class="nav-icon">
                                <i class="flaticon-information">
                                </i>
                            </span>
                            <span class="nav-text">
                                Tentang Peta
                            </span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content mt-5" id="myTabContent">
                    <div aria-labelledby="kt_tab_pane_2" class="tab-pane fade" id="style_tab" role="tabpanel">
                       <?php echo $__env->make('pages.analisa.modal_setting.styling', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div aria-labelledby="kt_tab_pane_2" class="tab-pane fade" id="analisa_query_tab" role="tabpanel">
                      <?php echo $__env->make('pages.analisa.modal_setting.query', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div aria-labelledby="kt_tab_pane_3" class="tab-pane fade" id="analisa_buffer_tab" role="tabpanel">
                        <?php echo $__env->make('pages.analisa.modal_setting.buffer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div aria-labelledby="kt_tab_pane_4" class="tab-pane fade" id="filter_peta_tab" role="tabpanel">
                        <?php echo $__env->make('pages.analisa.modal_setting.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div aria-labelledby="kt_tab_pane_4" class="tab-pane fade show active" id="tentang_peta_tab" role="tabpanel">
                        <?php echo $__env->make('pages.analisa.modal_setting.tentang', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/analisa/modal_setting.blade.php ENDPATH**/ ?>