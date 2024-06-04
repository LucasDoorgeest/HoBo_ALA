<?php
function headerBlock() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    print_r($_SESSION["user"]);
    ?>
    <header>
            <figure id="logo">
            <a href="/pages/home.php">
                <img src="/img/logo_full.png" alt="Logo">
                <figcaption class="d-none">
                    HoBo logo
                </figcaption>
            </a>
            </figure>
        <nav>
            <section id="searchWrap">
                <input type="text" id="searchText" placeholder="Search...">
                <button id="search">
                    <img src="/img/search_icon.svg" alt="Search">
                    <figcaption class="d-none">
                        Search icon
                    </figcaption>
                </button>
            </section>
            <section id="settings">
                <figure>
                    <img src="/img/settings_icon.svg" alt="Settings">
                    <figcaption class="d-none">
                        Settings icon
                    </figcaption>
                </figure>
            </section>
            <section>
                <figure id="profile">
                    <img src="/img/profile_icon.svg" alt="Profile">
                    <figcaption class="d-none">
                        Profile icon
                    </figcaption>
                </figure>
            </section>
        </nav>
    </header>

    <script>
        function search() {
            const search = document.getElementById("searchText").value;
            window.location.href = `/pages/search.php?q=${search}`;
        }

        document.getElementById("search").addEventListener("click", search);
        document.getElementById("searchText").addEventListener("keyup", (e) => {
            if (e.key === "Enter") {
                search();
            }
        });     
    </script>



    <?php
}