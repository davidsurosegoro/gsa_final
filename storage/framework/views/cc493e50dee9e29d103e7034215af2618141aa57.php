
<?php $__env->startSection('content'); ?>
<div class="card card-custom gutter-b example example-compact">
  <div class="card-header">
    <h3 class="card-title">FORM UBAH DATA USER LOGIN </h3>
  </div>
<form class="form" method="POST" 
    <?php if($users->id == 0): ?>
        action="<?php echo e(url('master/users/save')); ?>"
    <?php else: ?>
        action="<?php echo e(url('master/users/update')); ?>"
    <?php endif; ?>    
  >      
  <input type="hidden" name="id" value="<?php echo e($users->id); ?>">
  <?php echo e(csrf_field()); ?>

  <div class="card-body">
    <?php if($users->id == 0): ?>
        <div class="alert alert-warning" role="alert">
            * Password default user login baru adalah <b>"qwerty"</b><br>
            * Password dapat dirubah saat login, pada menu account setting
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Nama User:</label>
                <input type="text" required class="form-control" name="nama" value="<?php echo e($users->nama); ?>" />        
            </div>
            <div class="form-group">
                <label>Username User: <span class="d-none" id='warningusername' style='color:red; font-weight:bold;'>(username sudah digunakan)</span></label>
                <input type="text" 
                <?php if($users->id > 0): ?>
                    readonly style="background-color:#e4e4e4;"
                <?php endif; ?>
                required class="form-control" name="username" value="<?php echo e($users->username); ?>" id="username" />        
            </div>
            <div class="form-group">
                <label>No Telp User:</label>
                <input type="text" class="form-control" name="notelp" value="<?php echo e($users->notelp); ?>" />        
            </div>
            <div class="form-group">
                <label>Alamat User:</label>
                <input type="text" class="form-control" name="alamat" value="<?php echo e($users->alamat); ?>" />        
            </div>
            <div class="form-group">
                <label>Email User:</label>
                <input type="text" class="form-control" name="email" value="<?php echo e($users->email); ?>" />        
            </div>
        </div>   
        <div class="col-lg-6">
            <div class="form-group">
                <label>Tipe Login:</label>
                <select class="custom-select" required  name="level" id="level">
                    <option value='' >Choose...</option>                    
                    <option value='1' <?php if($users->level == 1): ?>selected <?php endif; ?>>Admin GSA</option>                    
                    <option value='2' <?php if($users->level == 2): ?>selected <?php endif; ?>>Customer </option>                    
                    <option value='3' <?php if($users->level == 3): ?>selected <?php endif; ?>>Kantor Agen</option>                    
                    <option value='4' <?php if($users->level == 4): ?>selected <?php endif; ?>>Kurir Delivery Agen</option>                    
                </select>        
            </div> 
            <div class="form-group " id='groupcustomer'>
                <label>Belongs to Customer:</label>
                <select class="custom-select"  name="id_customer" id="id_customer">
                    <option value='' >Choose...</option>
                    <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option 
                            <?php if($item->id == $users->id_customer): ?>
                                selected
                            <?php endif; ?>
                            value="<?php echo e($item->id); ?>"><?php echo e($item->kode); ?> - <?php echo e($item->nama); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>        
            </div> 
            <div class="form-group" id='groupagen'>
                <label>Belongs to Agen:</label>
                <select class="custom-select"  name="id_agen" id="id_agen">
                    <option value='' >Choose...</option>
                    <?php $__currentLoopData = $agen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option 
                            <?php if($item->id == $users->id_agen): ?>
                                selected
                            <?php endif; ?>
                            value="<?php echo e($item->id); ?>"><?php echo e($item->kode); ?> - <?php echo e($item->nama); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>        
            </div>
        </div>   
    </div>
  <div class="card-footer">
   <div class="row">
    <div class="col-lg-6">
     <button type="submit" id='simpanbutton' class="btn btn-primary mr-2">SIMPAN</button>
     <?php if($users->id == 0): ?><button type="reset" class="btn btn-secondary">Cancel</button><?php endif; ?>
    </div>
   </div>
  </div>
 </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        checkhidden(0)
    
        function checkhidden(resetval){
            if(resetval==1){
                console.log('masuk  ')
                $('#id_customer'    ).val(0)
                $('#id_agen'        ).val(0)        
                
                $("#id_customer").prop('required',false);
                $("#id_agen").prop('required',false);    
            }

            $('#groupcustomer'  ).removeClass('d-none')
            $('#groupagen'      ).removeClass('d-none')
            if($('#level').val()==1 || $('#level').val()==0 ){
                $('#groupcustomer').addClass('d-none')
                $('#groupagen'    ).addClass('d-none')
            }
            else if($('#level').val()==2 ){
                $('#groupagen').addClass('d-none')
                $("#id_customer").prop('required',true);
            }        
            else if($('#level').val()==3 || $('#level').val()==4 ){
                $('#groupcustomer').addClass('d-none')
                $("#id_agen").prop('required',true);
            } 
        }
        
        function checkusername() {
            $.ajax({
                method  :'GET',
                url     :'<?php echo e(url('master/users/checkusername')); ?>',
                data    :{
                    username:$('#username').val()
                },
                success:function(data){
                    if(data.username.length>0){
                        $('#username').css('background-color','#ffafaf')
                        $('#warningusername').removeClass("d-none")
                        $('#simpanbutton'   ).attr("disabled", true)
                    }else{
                        $('#username').css('background-color','white')
                        $('#warningusername').addClass("d-none")
                        $('#simpanbutton'   ).attr("disabled", false)
                    }
                }
            }) 
        }
        $("#level").change(function() {
            checkhidden(1)
        });
        $("#username").keyup(function() {
            <?php if($users->id == 0): ?>
                clearTimeout(timertyping); 
                timertyping = setTimeout(checkusername, 1000)
            <?php endif; ?>
        });
    })
    
    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/master/users/edit.blade.php ENDPATH**/ ?>