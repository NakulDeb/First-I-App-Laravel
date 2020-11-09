<?php $__env->startSection('content'); ?>
    <section>
        <div class="container py-5">
            <div class="row justify-content-between">
                <div class="col-12">
                    <?php if(Session::has('success-message')): ?>
                        <div class=" shadow">
                            <p class="text-center text-success font-weight-bold p-2"><?php echo e(Session::get('success-message')); ?></p>
                        </div>

                    <?php endif; ?>


                    <h5 class="text-center pb-5"><?php echo e(empty($post) ? "CREATE POST" : "EDIT POST"); ?></h5>
                    <form action="<?php echo e(empty($post) ? Route('post.store') : Route('post.update',$post->id)); ?>" method="post" enctype="multipart/form-data">
                        <?php if(empty($post)): ?>
                            <?php echo method_field('POST'); ?>
                        <?php else: ?>
                            <?php echo method_field('PUT'); ?>
                        <?php endif; ?>

                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="<?php echo e(!empty($post) ? $post->title : ""); ?>">
                        </div>
                        <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="Body Content"><?php echo e(!empty($post) ? $post->body : ""); ?></textarea>
                        </div>
                        <div class="form-group">
                            <?php if(!empty($post)): ?>
                            <img src="<?php echo e(asset('storage/'.$post->image)); ?>" class="py-2" alt="" srcset="" style="width:100px"> Old Image
                            <?php endif; ?>
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>
                        <input type="submit" value="<?php echo e(empty($post) ? "CREATE POST" : "UPDATE POST"); ?>" class="btn btn-primary btn-block">
                    </form>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backendApp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nakul\FirstApp\resources\views/Backend/post/create-post.blade.php ENDPATH**/ ?>