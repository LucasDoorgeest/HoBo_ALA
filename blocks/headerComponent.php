<?php
class HeaderComponent {
    static public function render() {
        ?>
    <header>
            <figure id="logo">
                <a href="/pages/home.php">
                    <img class="logo-img" src="/img/logo_full.png" alt="Logo">
                    <img class="logo-img-small" src="/img/logo_small.png" alt="Logo">
                    <figcaption class="d-none">HoBo logo</figcaption>
                </a>
            </figure>
            <nav>
                <section id="searchWrap">
                    <input type="text" id="searchText" placeholder="Search...">
                    <button id="search">
                        <img src="/img/search_icon.svg" alt="Search">
                        <figcaption class="d-none">Search icon</figcaption>
                    </button>
                </section>
                <?php if (isset($_SESSION["user"]) && ($_SESSION["user"]["AboID"] == 4)) { ?>
                    <section>
                        <figure id="beheer">
                            <a href="/pages/beheer.php">
                                <img src="/img/settings_icon.svg" alt="History">
                                <figcaption class="d-none">Beheer icon</figcaption>
                            </a>
                        </figure>
                    </section>
                <?php } ?>
                <section>
                    <figure id="profile">
                        <a href="/pages/profile.php">
                            <img src="/img/profile_icon.svg" alt="Profile">
                            <figcaption class="d-none">Profile icon</figcaption>
                        </a>
                    </figure>
                </section>
            </nav>
        </header>
        <script>
            function search() {
                const search = document.getElementById("searchText").value;
                //Check get parameters
                if (window.location.href.includes("?")) {
                    window.location.href = `/pages/search.php?q=${search}&${window.location.href.split("?")[1].split("&").filter((param) => !param.includes("q")).join("&")}`;
                    return;
                } else {
                    window.location.href = `/pages/search.php?q=${search}`;
                }
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
}