<?php $__env->startSection('content'); ?>
<div class="container">

    <?php if(!empty($posts)): ?>

        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row justify-content-center py-3">
                <div class="col-sm-11 col-md-10 col-lg-9 py-2 shadow">
                    <h5 class="text-seconday"><?php echo e($post->title); ?></h5>
                    <span><?php echo e($post->created_at); ?></span>
                    <p class="text-secondary"><?php echo e(!empty($post->user->name) ? $post->user->name: "UnKnown Author"); ?></p>
                    <div class="post-img">
                        <img src="<?php echo e(asset('storage/'.$post->image)); ?>" alt="" srcset="" style="width:100%">
                    </div>
                    <div class="text-body pt-3">
                        <p class="text-justify">
                            <?php echo e($post->body); ?>

                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        


        <form action="<?php echo e(Route('home')); ?>" method="get">
            <div class="row justify-content-center">
                    <div class="col-md-5 col-lg-4">
                        <select name="items" id="items" class="form-control">
                            <option>Select Page Items</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" value="Set items" class="btn btn-sm btn-primary">
                    </div>
            </div>
        </form>


        <div class="text-center">Show <?php echo e($posts->perPage() * $posts->currentPage() - $posts->perPage() +1); ?> to <?php echo e($posts->perPage() * $posts->currentPage() - $posts->perPage() + count($posts->items())); ?> of <?php echo e($totalpost); ?></div>
        <div class="pagination justify-content-center py-3">

            <?php
                $itemsArray = [
                    'items' => request()->query('items'),
                ];
            ?>
            <div class=""><?php echo e($posts->appends($itemsArray)->links()); ?></div>
        </div>
    <?php else: ?>
        <h4 class="text-center text-secondary">Empty</h4>
    <?php endif; ?>





</div>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nakul\FirstApp\resources\views/home.blade.php ENDPATH**/ ?>