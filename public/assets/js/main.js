document.addEventListener("DOMContentLoaded", function () {
    initThemeToggle();
    initMobileMenu();
    initLiveSearch();
    initLoginValidation();
    initEditorPreview();
    initAdminTableSearch();
    initDeleteConfirmation();
    initCopyLink();
});

function initThemeToggle() {
    const button = document.getElementById("themeToggle");
    if (!button) return;

    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        document.body.classList.add("dark");
        button.textContent = "☀️";
    }

    button.addEventListener("click", function () {
        document.body.classList.toggle("dark");

        if (document.body.classList.contains("dark")) {
            localStorage.setItem("theme", "dark");
            button.textContent = "☀️";
        } else {
            localStorage.setItem("theme", "light");
            button.textContent = "🌙";
        }
    });
}

function initMobileMenu() {
    const burger = document.getElementById("burgerBtn");
    const nav = document.getElementById("mainNav");

    if (!burger || !nav) return;

    burger.addEventListener("click", function () {
        nav.classList.toggle("open");
    });
}

function initLiveSearch() {
    const input = document.getElementById("liveSearchInput");
    const list = document.getElementById("newsList");
    const form = document.getElementById("searchForm");

    if (!input || !list || !form) return;

    form.addEventListener("submit", function (event) {
        event.preventDefault();
    });

    input.addEventListener("input", function () {
        const query = input.value.trim();

        fetch("api/search.php?q=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                renderNews(data, list);
            })
            .catch(() => {
                list.innerHTML = "<p class='empty'>Помилка виконання пошуку.</p>";
            });
    });
}

function renderNews(news, container) {
    container.innerHTML = "";

    if (news.length === 0) {
        container.innerHTML = "<p class='empty'>Новини не знайдено.</p>";
        return;
    }

    news.forEach(item => {
        const card = document.createElement("article");
        card.className = "news-card";
        card.innerHTML = `
            <span class="category">${escapeHtml(item.category)}</span>
            <h3>${escapeHtml(item.title)}</h3>
            <p>${escapeHtml(item.short_description)}</p>
            <div class="card-meta">
                <small>${escapeHtml(item.publish_date)}</small>
                <small>👁 ${Number(item.views)}</small>
            </div>
            <a href="news.php?id=${Number(item.id)}">Читати далі</a>
        `;
        container.appendChild(card);
    });
}

function initLoginValidation() {
    const form = document.getElementById("loginForm");
    if (!form) return;

    form.addEventListener("submit", function (event) {
        const login = document.getElementById("login").value.trim();
        const password = document.getElementById("password").value.trim();

        if (login.length < 3 || password.length < 3) {
            event.preventDefault();
            alert("Логін і пароль повинні містити не менше 3 символів.");
        }
    });
}

function initEditorPreview() {
    const form = document.getElementById("newsEditorForm");
    if (!form) return;

    const title = document.getElementById("title");
    const shortDescription = document.getElementById("shortDescription");
    const category = document.getElementById("category");
    const publishDate = document.getElementById("publishDate");
    const content = document.getElementById("content");

    const previewTitle = document.getElementById("previewTitle");
    const previewDescription = document.getElementById("previewDescription");
    const previewCategory = document.getElementById("previewCategory");
    const previewDate = document.getElementById("previewDate");

    const shortCounter = document.getElementById("shortCounter");
    const contentCounter = document.getElementById("contentCounter");

    function updatePreview() {
        previewTitle.textContent = title.value || "Заголовок новини";
        previewDescription.textContent = shortDescription.value || "Короткий опис новини буде відображений тут.";
        previewCategory.textContent = category.value;
        previewDate.textContent = publishDate.value || "Дата публікації";

        shortCounter.textContent = `${shortDescription.value.length} / 500 символів`;
        contentCounter.textContent = `${content.value.length} символів`;
    }

    [title, shortDescription, category, publishDate, content].forEach(element => {
        element.addEventListener("input", updatePreview);
        element.addEventListener("change", updatePreview);
    });

    form.addEventListener("submit", function (event) {
        if (title.value.trim().length < 5) {
            event.preventDefault();
            alert("Заголовок повинен містити не менше 5 символів.");
            return;
        }

        if (shortDescription.value.trim().length < 20) {
            event.preventDefault();
            alert("Короткий опис повинен містити не менше 20 символів.");
            return;
        }

        if (content.value.trim().length < 50) {
            event.preventDefault();
            alert("Текст новини повинен містити не менше 50 символів.");
        }
    });

    updatePreview();
}

function initAdminTableSearch() {
    const input = document.getElementById("adminTableSearch");
    const table = document.getElementById("adminNewsTable");

    if (!input || !table) return;

    input.addEventListener("input", function () {
        const value = input.value.toLowerCase();
        const rows = table.querySelectorAll("tr");

        rows.forEach((row, index) => {
            if (index === 0) return;

            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? "" : "none";
        });
    });
}

function initDeleteConfirmation() {
    const links = document.querySelectorAll(".delete-link");

    links.forEach(link => {
        link.addEventListener("click", function (event) {
            const ok = confirm("Ви дійсно хочете видалити цю новину?");
            if (!ok) {
                event.preventDefault();
            }
        });
    });
}

function initCopyLink() {
    const button = document.getElementById("copyLinkBtn");
    if (!button) return;

    button.addEventListener("click", function () {
        navigator.clipboard.writeText(window.location.href)
            .then(() => alert("Посилання скопійовано!"))
            .catch(() => alert("Не вдалося скопіювати посилання."));
    });
}

function escapeHtml(value) {
    return String(value)
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#039;");
}
