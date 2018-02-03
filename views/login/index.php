<form action="/php-mvc-news/web/?r=Login" method="post">

    <div class="container">
        <label><b>Username</b></label>
        <input type="text" placeholder="Benutzername" name="username" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Passwort" name="password" required>

        <button type="submit">Login</button>
    </div>
</form>

<?= (!empty($error)) ? $error : ''; ?>