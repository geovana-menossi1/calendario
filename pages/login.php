<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Calendário</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="background-up"></div>
    <div class="background-down"></div>
    <main class="pai">
        <div class="conteudo">
            <div class="container">
                <div class="heading">Login</div>
                <form action="../back/userLogin.php" method="post" class="form">
                    <input required class="input" type="email" name="email_usuario" id="email_usuario" placeholder="E-mail">
                    <input required class="input" type="password" name="pass" id="pass" placeholder="Password">
                    <span class="forgot-password"><a href="cadastro.php">Cadastre-se aqui</a></span>
                    <input class="login-button" type="submit" value="Login" name="bt_entrar" id="bt_entrar">
                </form>
            </div>
        </div>

        <div class="move_menu">
            <menu class="menu" style="--timeOut: none">
                <button class="menu__item" style="--bgColorItem: #4343f5">
                    <a href="../index.php" class="link-suave">
                        <svg class="icon" viewBox="0 0 24 24">
                            <path d="M3.8,6.6h16.4"></path>
                            <path d="M20.2,12.1H3.8"></path>
                            <path d="M3.8,17.5h16.4"></path>
                        </svg>
                    </a>
                </button>
                <button class="menu__item active" style="--bgColorItem: #4343f5">
                <a href="login.php" class="link-suave">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M6.7,4.8h10.7c0.3,0,0.6,0.2,0.7,0.5l2.8,7.3c0,0.1,0,0.2,0,0.3v5.6c0,0.4-0.4,0.8-0.8,0.8H3.8 C3.4,19.3,3,19,3,18.5v-5.6c0-0.1,0-0.2,0.1-0.3L6,5.3C6.1,5,6.4,4.8,6.7,4.8z"></path>
                        <path d="M3.4,12.9H8l1.6,2.8h4.9l1.5-2.8h4.6"></path>
                    </svg>
                </button>
                <button class="menu__item" style="--bgColorItem: #4343f5">
                    <a href="tarefa.php" class="link-suave">
                        <svg class="icon" viewBox="0 0 24 24">
                            <path d="M3.4,11.9l8.8,4.4l8.4-4.4"></path>
                            <path d="M3.4,16.2l8.8,4.5l8.4-4.5"></path>
                            <path d="M3.7,7.8l8.6-4.5l8,4.5l-8,4.3L3.7,7.8z"></path>
                        </svg>
                    </a>
                </button>
                <button class="menu__item" style="--bgColorItem: #4343f5">
                    <a href="lista.php" class="link-suave">
                        <svg class="icon" viewBox="0 0 24 24">
                            <path d="M5.1,3.9h13.9c0.6,0,1.2,0.5,1.2,1.2v13.9c0,0.6-0.5,1.2-1.2,1.2H5.1c-0.6,0-1.2-0.5-1.2-1.2V5.1 C3.9,4.4,4.4,3.9,5.1,3.9z"></path>
                            <path d="M4.2,9.3h15.6"></path>
                            <path d="M9.1,9.5v10.3"></path>
                        </svg>
                    </a>
                </button>
                <div class="menu__border" style="transform: translate3d(0px, 0px, 0px)"></div>
            </menu>
            <div class="svg-container">
                <svg viewBox="0 0 202.9 45.5">
                    <clipPath id="menu" clipPathUnits="objectBoundingBox" transform="scale(0.0049285362247413 0.021978021978022)">
                        <path d="M6.7,45.5c5.7,0.1,14.1-0.4,23.3-4c5.7-2.3,9.9-5,18.1-10.5c10.7-7.1,11.8-9.2,20.6-14.3c5-2.9,9.2-5.2,15.2-7 c7.1-2.1,13.3-2.3,17.6-2.1c4.2-0.2,10.5,0.1,17.6,2.1c6.1,1.8,10.2,4.1,15.2,7c8.8,5,9.9,7.1,20.6,14.3c8.3,5.5,12.4,8.2,18.1,10.5 c9.2,3.6,17.6,4.2,23.3,4H6.7z"></path>
                    </clipPath>
                </svg>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        "use strict";

        const body = document.body;
        const menu = body.querySelector(".menu");
        const menuItems = menu.querySelectorAll(".menu__item");
        const menuBorder = menu.querySelector(".menu__border");
        let activeItem = menu.querySelector(".active");

        function clickItem(item, index) {
            menu.style.removeProperty("--timeOut");
            if (activeItem === item) return;

            if (activeItem) {
                activeItem.classList.remove("active");
            }

            item.classList.add("active");
            activeItem = item;
            offsetMenuBorder(activeItem, menuBorder);
        }

        function offsetMenuBorder(element, menuBorder) {
            const offsetActiveItem = element.getBoundingClientRect();
            const left = Math.floor(offsetActiveItem.left - menu.offsetLeft - (menuBorder.offsetWidth - offsetActiveItem.width) / 2) + "px";
            menuBorder.style.transform = `translate3d(${left}, 0 , 0)`;
        }

        offsetMenuBorder(activeItem, menuBorder);

        menuItems.forEach((item, index) => {
            item.addEventListener("click", () => clickItem(item, index));
        });

        window.addEventListener("resize", () => {
            offsetMenuBorder(activeItem, menuBorder);
            menu.style.setProperty("--timeOut", "none");
        });

        document.addEventListener('DOMContentLoaded', () => {
            const links = document.querySelectorAll('a.link-suave');

            for (let link of links) {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const href = link.getAttribute('href');
                    document.body.classList.add('fade-out');
                    setTimeout(() => {
                        window.location.href = href;
                    }, 500); // Tempo da transição em milissegundos (0.5s)
                });
            }
        });
    </script>
</body>
</html>
