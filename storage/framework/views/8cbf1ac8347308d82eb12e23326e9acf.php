



<?php
$logo  =\App\Models\Utility::get_file(config('chatify.user_avatar.folder')); 
$avatar = \App\Models\Utility::get_file('/avatars/');
?>

<?php if(!empty(\Auth::user()->avatar)): ?>
<div class="avatar av-l" style="background-image: url('<?php echo e($avatar.Auth::user()->avatar); ?>');" ></div>
<?php else: ?>
    <div class="avatar av-l"
         style="background-image:  url('<?php echo e($avatar.'avatar.png'); ?>');">
    </div>
<?php endif; ?>
<p class="info-name"><?php echo e(config('chatify.name')); ?></p>
<div class="messenger-infoView-btns">
    
    <a href="#" class="danger delete-conversation"><i class="fas fa-trash-alt"></i> Delete Conversation</a>
</div>

<div class="messenger-infoView-shared">
    <p class="messenger-title">shared photos</p>
    <div class="shared-photos-list"></div>
</div><?php /**PATH D:\laragon\www\taskly\resources\views/vendor/Chatify/layouts/info.blade.php ENDPATH**/ ?>