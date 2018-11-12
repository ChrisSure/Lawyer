<?php

use App\Common\Entity\User;
use App\Cabinet\Entity\Profile;
use App\Common\Entity\Articles;
use App\Common\Entity\Pages;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;

Breadcrumbs::register('home', function (Crumbs $crumbs) {
    $crumbs->push('Головна', route('home'));
});

Breadcrumbs::register('articles', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Юридичні статті', route('articles'));
});
Breadcrumbs::register('articles.show', function (Crumbs $crumbs, Articles $article) {
    $crumbs->parent('articles');
    $crumbs->push($article->name, route('articles.show', $article));
});


Breadcrumbs::register('about', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Про нас', route('about'));
});

Breadcrumbs::register('contacts', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Контакти', route('contacts'));
});

Breadcrumbs::register('login', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Логін', route('login'));
});

Breadcrumbs::register('register', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Реєстрація', route('register'));
});

Breadcrumbs::register('password.request', function (Crumbs $crumbs) {
    $crumbs->parent('login');
    $crumbs->push('Скидання пароля', route('password.request'));
});

Breadcrumbs::register('password.reset', function (Crumbs $crumbs, $token) {
    $crumbs->parent('login');
    $crumbs->push('Зміна пароля', route('password.reset', $token));
});

//////////// STATE /////////////////////////////

Breadcrumbs::register('state.pay', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Оплата послуги', route('state.pay'));
});
Breadcrumbs::register('state.end', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Завершення оплати', route('state.end'));
});

Breadcrumbs::register('state.n1', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Позовна заява про стягнення боргу', route('state.n1'));
});



///////////// CABINET //////////////////////////

Breadcrumbs::register('cabinet.home', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Кабінет', route('cabinet.home'));
});

// Cabinet.Articles
Breadcrumbs::register('cabinet.articles.index', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.home');
    $crumbs->push('Мої юридичні статті', route('cabinet.articles.index'));
});

Breadcrumbs::register('cabinet.articles.create', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.articles.index');
    $crumbs->push('Додати юридичну статтю', route('cabinet.articles.create'));
});

Breadcrumbs::register('cabinet.articles.show', function (Crumbs $crumbs, Articles $article) {
    $crumbs->parent('cabinet.articles.index');
    $crumbs->push("Перегляд - " . $article->name, route('cabinet.articles.show', $article));
});

Breadcrumbs::register('cabinet.articles.edit', function (Crumbs $crumbs, Articles $article) {
    $crumbs->parent('cabinet.articles.show', $article);
    $crumbs->push('Редагування - ' . $article->name, route('cabinet.articles.edit', $article));
});

Breadcrumbs::register('cabinet.main', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.home');
    $crumbs->push('Редагування основних даних', route('cabinet.main'));
});

Breadcrumbs::register('cabinet.profile', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.home');
    $crumbs->push('Редагування профілю', route('cabinet.profile'));
});

///////////// CABINET //////////////////////////


///////////// ADMIN //////////////////////////



Breadcrumbs::register('admin.home', function (Crumbs $crumbs) {
    $crumbs->push('Головна', route('admin.home'));
});

// Admin.User

Breadcrumbs::register('admin.users.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Користувачі', route('admin.users.index'));
});

Breadcrumbs::register('admin.users.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.users.index');
    $crumbs->push('Додати користувача', route('admin.users.create'));
});

Breadcrumbs::register('admin.users.show', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.index');
    $crumbs->push("Перегляд - " . $user->name, route('admin.users.show', $user));
});

Breadcrumbs::register('admin.users.edit', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push('Редагування - ' . $user->name, route('admin.users.edit', $user));
});


// Admin.Articles
Breadcrumbs::register('admin.articles.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Юридичні статті', route('admin.articles.index'));
});
Breadcrumbs::register('admin.articles.show', function (Crumbs $crumbs, Articles $articles) {
    $crumbs->parent('admin.articles.index');
    $crumbs->push("Перегляд - " . $articles->name, route('admin.articles.show', $articles));
});

//Admin.Reverse
Breadcrumbs::register('admin.reverse.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Листи від користувачів', route('admin.reverse.index'));
});

//Admin.Mail
Breadcrumbs::register('admin.mail.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Розсилки', route('admin.mail.index'));
});
Breadcrumbs::register('admin.mail.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.mail.index');
    $crumbs->push('Додати розсилку', route('admin.mail.create'));
});

//Admin.Sub
Breadcrumbs::register('admin.sub.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.mail.index');
    $crumbs->push('Список підписників', route('admin.sub.index'));
});

//Admin.Setting.Pages
Breadcrumbs::register('admin.pages.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Сторінки', route('admin.pages.index'));
});

Breadcrumbs::register('admin.pages.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.pages.index');
    $crumbs->push('Додати сторінку', route('admin.pages.create'));
});

Breadcrumbs::register('admin.pages.edit', function (Crumbs $crumbs, Pages $page) {
    $crumbs->parent('admin.pages.index');
    $crumbs->push('Обновити сторінку ' . $page->name, route('admin.pages.edit', $page));
});

Breadcrumbs::register('admin.pages.show', function (Crumbs $crumbs, Pages $page) {
    $crumbs->parent('admin.pages.index');
    $crumbs->push('Cторінка ' . $page->name, route('admin.pages.show', $page));
});



//Admin.Setting.Logs
Breadcrumbs::register('admin.logs.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Логи', route('admin.logs.index'));
});

//Admin.Setting.Info
Breadcrumbs::register('admin.info.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Інформація про систему', route('admin.info.index'));
});

///////////// ADMIN //////////////////////////