<div class="container text-center">
    <div class="row">
        <div class="col-10" style="text-align: left;">
            <h1>Users: </h1>

            <form method="post" action="users/create">
                <div class="mb-3">
                    <label for="name" class="form-label">Name: </label>
                    <input type="input" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Surname: </label>
                    <input type="input" class="form-control" id="surname" name="surname">
                </div>
                <button type="submit" class="btn btn-primary">Добавить пользователя</button>
            </form>
            <form method="post" action="users/delete">
                <div class="mb-3">
                    <label for="id" class="form-label">ID: </label>
                    <input type="input" class="form-control" id="id" name="id">
                </div>
                <button type="submit" class="btn btn-primary">Удалить пользователя по ID</button>
            </form>

            <form method="post" action="users/update">
                <div class="mb-3">
                    <label for="id" class="form-label">ID: </label>
                    <input type="input" class="form-control" id="id" name="id">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name: </label>
                    <input type="input" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Surname: </label>
                    <input type="input" class="form-control" id="surname" name="surname">
                </div>
                <button type="submit" class="btn btn-primary">Обновить пользователя по ID</button>
            </form>

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <th scope="row"><?= $user->getId(); ?></th>
                            <th><?= $user->getName(); ?></th>
                            <th><?= $user->getSurname(); ?></th>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>