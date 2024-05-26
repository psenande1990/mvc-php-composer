<?php
    namespace App\Controllers;

    require_once '../app/core/app.php';
    require_once '../app/models/MenuItems.php';

    use Core\App;
    use App\Models\MenuItems;

    class HomeController extends App
    {

        function __construct()
        {
            // echo "En HomeController";
        }

        public function index()
        {
            $args = [
                'title' => 'Index'
            ];
            $this->render('home', $args, 'header.php', 'footer.php', 'admin');

        }

        public function dashboard()
        {
            $args = [
                'title' => 'Dashboard'
            ];
            $this->render('dashboard', $args);

        }

        public function home()
        {
            $args = [
                'title' => 'Home'
            ];
            $menu_items = new MenuItems();
            $items = $menu_items->all();
            $args['items'] = $items;
            $this->render('home', $args, 'header.php', 'footer.php', 'base');
        }

    }
