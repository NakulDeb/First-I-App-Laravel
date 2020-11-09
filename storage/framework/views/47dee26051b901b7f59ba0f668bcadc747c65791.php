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

                    <h5 class="text-center py-2">All Post</h5>


                    <table class="table table-striped table-hover border">
                        <thead>
                          <tr>
                            <th >Id</th>
                            <th >Author</th>
                            <th >Image</th>
                            <th >Title</th>
                            <th >Body</th>
                            <th >Created Date</th>
                            <th >Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($post->id); ?></th>
                                    <td><?php echo e($post->user->name); ?></td>
                                    <td><img src="<?php echo e(asset('storage/'.$post->image)); ?>" alt="" srcset="" style="width:100px"></td>
                                    <td class=" text-truncate" style="max-width: 120px"><?php echo e($post->title); ?></td>
                                    <td class=" text-truncate" style="max-width: 150px" ><?php echo e($post->body); ?></td>
                                    <td><?php echo e($post->created_at); ?></td>
                                    <td>
                                        <div class="float-right">
                                            <form action="<?php echo e(Route('post.update.status',$post->id)); ?>" method="post">
                                                <?php echo method_field('PUT'); ?>
                                                <?php echo csrf_field(); ?>
                                                <input type="submit" value="<?php echo e($post->status ? "Block" : "Unblock"); ?>" class="btn <?php echo e($post->status ? 'btn-secondary' : 'btn-primary'); ?>">
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="float-right">
                                            <a href="<?php echo e(Route('post.edit',$post->id)); ?>" class="btn btn-info">Edit</a>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="<?php echo e(Route('post.destroy',$post->id)); ?>" method="post">
                                            <?php echo method_field('DELETE'); ?>
                                            <?php echo csrf_field(); ?>
                                            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this post?')">
                                        </form>
                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backendApp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nakul\FirstApp\resources\views/Backend/post/posts.blade.php ENDPATH**/ ?>