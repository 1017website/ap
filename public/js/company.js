const defaultProducts = [
    ["Citric Acid Anhydrous", "Acidulant and Buffering Agent", "food"],
    ["Citric Acid Monohydrate", "Acidulant and Buffering Agent", "food"],
    ["DL Malic Acid", "Acidulant", "food"],
    ["Sodium Citrate", "Buffering Agent", "food"],
    ["BHA", "Antioxidant", "food"],
    ["BHT", "Antioxidant", "food"],
    ["Lecithin", "Emulsifier", "food"],
    ["Sodium Benzoate", "Preservative", "food"],
    ["Potassium Sorbate", "Preservative", "food"],
    ["Carrageenan", "Thickener and Stabilizer", "food"],
    ["Modified Starch", "Thickener and Stabilizer", "food"],
    ["Sucralose", "Sweetener", "food"],
    ["Copper Sulphate", "Mineral", "feed"],
    ["Dicalcium Phosphate", "Mineral", "feed"],
    ["Magnesium Oxide", "Mineral", "feed"],
    ["Vitamin C", "Vitamin", "feed"],
    ["Vitamin D3", "Vitamin", "feed"],
    ["Vitamin E50", "Vitamin", "feed"],
    ["Aluminium Sulfate", "Water Treatment Material", "industrial"],
    ["ATMP", "Water Treatment Material", "industrial"],
    ["Caustic Soda 48%", "Industrial Process Material", "industrial"],
    ["Caustic Soda Flake 98%", "Industrial Process Material", "industrial"],
    ["Hydrochloric Acid", "Industrial Process Material", "industrial"],
    ["Hydrogen Peroxide 50%", "Industrial Process Material", "industrial"],
    ["Sodium Hypochlorite", "Sanitation and Treatment Material", "industrial"],
    ["Sodium Sulfite", "Industrial Process Material", "industrial"]
];

const productData = document.getElementById("product-data");
const products = productData ? JSON.parse(productData.textContent) : defaultProducts;

const grid = document.getElementById("productGrid");
const search = document.getElementById("search");
const filterButtons = [...document.querySelectorAll("[data-filter]")];
let currentFilter = "all";

function renderProducts() {
    const query = search.value.toLowerCase().trim();
    const visibleProducts = products.filter(([name, functionName, category]) => {
        const matchesFilter = currentFilter === "all" || currentFilter === category;
        const matchesSearch = !query || `${name} ${functionName}`.toLowerCase().includes(query);
        return matchesFilter && matchesSearch;
    });

    grid.innerHTML = visibleProducts.length
        ? visibleProducts.map(([name, functionName]) => `<article class="product-card"><div><small>${functionName}</small><h4>${name}</h4></div><a href="mailto:sales@ap-indonesia.com?subject=${encodeURIComponent(`Raw Material Inquiry: ${name}`)}">INQUIRE ABOUT PRODUCT</a></article>`).join("")
        : '<div class="empty">No matching material found. Contact sales for other requirements.</div>';
}

function setFilter(filter) {
    currentFilter = filter;
    filterButtons.forEach(button => button.setAttribute("aria-pressed", String(button.dataset.filter === filter)));
    renderProducts();
}

filterButtons.forEach(button => button.addEventListener("click", () => setFilter(button.dataset.filter)));
document.querySelectorAll("[data-filter-link]").forEach(link => link.addEventListener("click", () => setFilter(link.dataset.filterLink)));
search.addEventListener("input", renderProducts);

const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
            observer.unobserve(entry.target);
        }
    });
}, { threshold: .12 });

document.querySelectorAll(".reveal").forEach(element => observer.observe(element));
renderProducts();
