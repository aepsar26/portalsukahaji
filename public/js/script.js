// Animasi angka berjalan (counter) di Data Kependudukan
document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll(".stat-number");
    const speed = 200; // kecepatan animasi

    counters.forEach(counter => {
        const animate = () => {
            const value = +counter.getAttribute("data-count");
            const data = +counter.innerText;

            const increment = value / speed;

            if (data < value) {
                counter.innerText = Math.ceil(data + increment);
                setTimeout(animate, 10);
            } else {
                counter.innerText = value;
            }
        };

        animate();
    });
});
