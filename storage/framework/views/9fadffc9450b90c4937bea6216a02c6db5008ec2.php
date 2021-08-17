<?php $__currentLoopData = $form_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($f->column_name !== "geom" && $loop->iteration > 1): ?>
<tr>
	<td>
	<span class="edit_kolom" > <?php echo e($f->column_name); ?></span> 
    <input type="text" class="txteditkolom" value="<?php echo e($f->column_name); ?>" id="<?php echo e($f->column_name); ?>" >
</td>
</tr>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script type="text/javascript">
	
 $('.edit_kolom').on('click',function(){
  $('.txteditkolom').hide();
  $(this).next('.txteditkolom').show().focus();
  $(this).hide();
 });
  $(".txteditkolom").focusout(function(){
  	var id = this.id;
  var split_id = id.split("_");
  var value = $(this).val();
  // Hide Input element
  
    $(this).attr("id",value)
  	$(this).hide(); 
  // Hide and Change Text of the container with input elmeent
  $(this).prev('.edit_kolom').show();
  $(this).prev('.edit_kolom').text(value);
  $.ajax({
  	method:'POST',
  	url:base_url+'ajax/master/update-attr',
  	data:{
		'map_name':$('#map_name').val(),
		'next_column_name':value,
    '_token': $('input[name=_token]').val(),
		'prev_column_name':id
  	},
  	success:function(data){
	     console.log(data);
        toastr.success("Kolom berhasil diubah!");
  }
})
});
</script><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/master_peta/ajax/attribut_query_edit.blade.php ENDPATH**/ ?>