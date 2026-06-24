<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Aerts Action Bike Watt Battle - Live Scoreboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/pro-benchmarks.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="dashboard-page">

    <main class="dashboard">
        <header class="dashboard-header">
            <div class="dashboard-brand">
                <img src="assets/Aerts2015CMYK-blackletters.svg" alt="Aerts Action Bike" class="brand-logo">
                <div>
                    <div class="brand-label">Live challenge</div>
                    <h1>Watt Battle</h1>
                </div>
            </div>

            <div class="live-pill">LIVE</div>
        </header>

        <section class="slide scoreboard-slide is-active" data-slide="men">
            <section class="winner-card">
                <div class="winner-content">
                    <p class="winner-label">Mannen competitie</p>
                    <h2 id="winner-name-men">Nog geen score</h2>
                    <div id="winner-wattage-men" class="winner-wattage">0 W</div>
                    <p class="winner-subtitle">Wie trapt de hoogste piekwattage?</p>
                </div>

                <div class="winner-side"><span>Peak Power</span></div>
            </section>

            <section class="scoreboard">
                <div class="scoreboard-head">
                    <span>Ranking</span>
                    <span>Naam</span>
                    <span>Wattage</span>
                </div>
                <div id="scores-list-men" class="scores-list">
                    <div class="empty-state">Wachten op eerste poging...</div>
                </div>
            </section>
        </section>

        <section class="slide scoreboard-slide" data-slide="women">
            <section class="winner-card">
                <div class="winner-content">
                    <p class="winner-label">Vrouwen competitie</p>
                    <h2 id="winner-name-women">Nog geen score</h2>
                    <div id="winner-wattage-women" class="winner-wattage">0 W</div>
                    <p class="winner-subtitle">De sterkste sprint van de dag.</p>
                </div>

                <div class="winner-side"><span>Peak Power</span></div>
            </section>

            <section class="scoreboard">
                <div class="scoreboard-head">
                    <span>Ranking</span>
                    <span>Naam</span>
                    <span>Wattage</span>
                </div>
                <div id="scores-list-women" class="scores-list">
                    <div class="empty-state">Wachten op eerste poging...</div>
                </div>
            </section>
        </section>

        <section class="slide scoreboard-slide" data-slide="kids">
            <section class="winner-card">
                <div class="winner-content">
                    <p class="winner-label">Jeugd competitie</p>
                    <h2 id="winner-name-kids">Nog geen score</h2>
                    <div id="winner-wattage-kids" class="winner-wattage">0 W</div>
                    <p class="winner-subtitle">Wie zet de strafste jeugdscore neer?</p>
                </div>

                <div class="winner-side"><span>Peak Power</span></div>
            </section>

            <section class="scoreboard">
                <div class="scoreboard-head">
                    <span>Ranking</span>
                    <span>Naam</span>
                    <span>Wattage</span>
                </div>
                <div id="scores-list-kids" class="scores-list">
                    <div class="empty-state">Wachten op eerste poging...</div>
                </div>
            </section>
        </section>

        <section class="slide benchmark-slide" data-slide="pros">
            <section class="benchmark-card">
                <div class="benchmark-intro">
                    <div class="brand-label">Pro benchmark</div>
                    <h2>Belgische profs</h2>
                    </div>

                <div id="pro-benchmarks" class="pro-grid"></div>
            </section>
        </section>

        <footer class="dashboard-footer">
            <div id="slide-title" class="slide-title">Mannen competitie</div>
            <div class="slide-dots" aria-hidden="true">
                <span class="dot is-active" data-dot="men"></span>
                <span class="dot" data-dot="women"></span>
                <span class="dot" data-dot="kids"></span>
                <span class="dot" data-dot="pros"></span>
            </div>
        </footer>
    </main>

    <script>
    const slideOrder = ["men", "women", "kids", "pros"];
    const slideLabels = {
        men: "Mannen competitie",
        women: "Vrouwen competitie",
        kids: "Jeugd competitie",
        pros: "Belgische profs - benchmark"
    };

    const proBenchmarks = [
        { image: "assets/pros/jasper.jpg", name: "Jasper Philipsen", type: "Topsprinter", watts: "1.500-1.700 W", note: "Referentie voor een pure massasprint." },
        { image: "assets/pros/tim.jpg", name: "Tim Merlier", type: "Topsprinter", watts: "1.500-1.700 W", note: "Explosieve sprintpower als richtpunt." },
        { image: "assets/pros/wout.jpg", name: "Wout van Aert", type: "Allrounder / sprint", watts: "1.400-1.600 W", note: "Bekend om sprint, tijdrit en klimvermogen." },
        { image: "assets/pros/remco.jpg", name: "Remco Evenepoel", type: "Tijdrit / klim", watts: "1.100-1.300 W", note: "Niet de pure sprinter, wel uitzonderlijk duurvermogen." },
        { image: "assets/pros/lotte.jpg", name: "Lotte Kopecky", type: "Punch / sprint", watts: "900-1.100 W", note: "Sterke referentie voor explosieve vrouwenpower." }
    ];

    let previousData = "";
    let currentSlideIndex = 0;

    async function loadScores() {
        try {
            const response = await fetch("scores.php?time=" + Date.now());
            const data = await response.json();
            const currentData = JSON.stringify(data);

            if (currentData === previousData) return;

            previousData = currentData;
            updateAllDashboards(data);
        } catch (error) {
            console.error("Scores laden mislukt:", error);
        }
    }

    function updateAllDashboards(data) {
        ["men", "women", "kids"].forEach(competition => {
            const competitionData = data[competition] || { scores: [] };
            updateDashboard(competition, competitionData.scores || []);
        });
    }

    function updateDashboard(competition, scores) {
        const list = document.getElementById("scores-list-" + competition);
        const winnerName = document.getElementById("winner-name-" + competition);
        const winnerWattage = document.getElementById("winner-wattage-" + competition);

        if (!scores.length) {
            winnerName.textContent = "Nog geen score";
            winnerWattage.textContent = "0 W";
            list.innerHTML = '<div class="empty-state">Wachten op eerste poging...</div>';
            return;
        }

        winnerName.textContent = scores[0].name;
        winnerWattage.textContent = scores[0].wattage + " W";
        list.innerHTML = "";

        scores.forEach((score, index) => {
            const row = document.createElement("div");
            row.className = "score-row";
            if (index === 0) row.classList.add("first");
            if (index === 1) row.classList.add("second");
            if (index === 2) row.classList.add("third");

            row.innerHTML = `
                <div class="rank">#${index + 1}</div>
                <div class="name"></div>
                <div class="wattage">${score.wattage} W</div>
            `;

            row.querySelector(".name").textContent = score.name;
            list.appendChild(row);
        });
    }

    function renderProBenchmarks() {
        const grid = document.getElementById("pro-benchmarks");

        grid.innerHTML = proBenchmarks.map(pro => `
            <article class="pro-card">
                <img src="${pro.image}" alt="${pro.name}" class="pro-photo">
                <div class="pro-overlay">
                    <span>${pro.type}</span>
                    <h3>${pro.name}</h3>
                    <strong>${pro.watts}</strong>
                    <p>${pro.note}</p>
                </div>
            </article>
        `).join("");
    }

    function showSlide(index) {
        currentSlideIndex = index % slideOrder.length;
        const activeSlide = slideOrder[currentSlideIndex];

        document.querySelectorAll(".slide").forEach(slide => {
            slide.classList.toggle("is-active", slide.dataset.slide === activeSlide);
        });

        document.querySelectorAll(".dot").forEach(dot => {
            dot.classList.toggle("is-active", dot.dataset.dot === activeSlide);
        });

        document.getElementById("slide-title").textContent = slideLabels[activeSlide];
    }

    function nextSlide() {
        showSlide(currentSlideIndex + 1);
    }

    renderProBenchmarks();
    loadScores();
    setInterval(loadScores, 2000);
    setInterval(nextSlide, 15000);
    </script>

</body>
</html>
