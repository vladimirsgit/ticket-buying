 <?php if (isset($_SESSION['invalid_action'])) {?>
            <p style="color: red">Invalid action request!</p>
        <?php } unset($_SESSION['invalid_action']);?>
        <?php if (isset($_SESSION['role_change_OK'])) { ?>
            <p style="color: #30bde7">User with the id: <?php echo $_SESSION['user_role_changed_id']?> was successfully <?php echo $_SESSION['action_made']?>!</p>
        <?php } unset($_SESSION['role_change_OK']);?>
        <table class="table table-striped table-hover table-dark table-bordered">
            <thead>
            <tr>
                <th colspan="4" class="text-center bg-info" >Users</th>
            </tr>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $userRepository = $entityManager->getRepository(User::class);
            $users = $userRepository->findBy(['confirmedemail' => true]);
            foreach ($users as $user){
                ?> <tr>
                    <td><?php echo htmlspecialchars($user->getId()); ?></td>
                    <td><?php echo htmlspecialchars($user->getUsername()); ?></td>
                    <td><?php echo htmlspecialchars($user->getRole()); ?></td>
                    <td>
                        <form method="post" action="adminDashboard" class="d-inline">
                            <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>"/>
                            <input type="submit" class="btn btn-primary btn-sm" name="roleAction" value="promote"/>
                            <input type="hidden" class="form-control" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                        </form>
                        <form method="post" action="adminDashboard" class="d-inline">
                            <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>"/>
                            <input type="submit" class="btn btn-warning btn-sm" name="roleAction" value="demote"/>
                            <input type="hidden" class="form-control" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                        </form>
                    </td>
                </tr> <?php }?>
            </tbody>