<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Aerts Action Bike Watt Battle - Live Scoreboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">

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

        <section id="winner" class="winner-card">
    <div class="winner-content">
        <p class="winner-label">Huidige leider</p>
        <h2 id="winner-name">Nog geen score</h2>
        <div id="winner-wattage" class="winner-wattage">0 W</div>
    </div>

    <div class="winner-side">
        <span>Peak Power</span>
    </div>
</section>

        <section class="scoreboard">
            <div class="scoreboard-head">
                <span>Ranking</span>
                <span>Naam</span>
                <span>Wattage</span>
            </div>

            <div id="scores-list" class="scores-list">
                <div class="empty-state">Wachten op eerste poging...</div>
            </div>
        </section>
    </main>

    <script>
    let previousData = "";

    async function loadScores() {
        try {
            const response = await fetch("scores.php?time=" + Date.now());
            const scores = await response.json();

            const currentData = JSON.stringify(scores);

            if (currentData === previousData) {
                return;
            }

            previousData = currentData;
            updateDashboard(scores);

        } catch (error) {
            console.error("Scores laden mislukt:", error);
        }
    }

    function updateDashboard(scores) {
        const list = document.getElementById("scores-list");
        const winnerName = document.getElementById("winner-name");
        const winnerWattage = document.getElementById("winner-wattage");

        if (!scores.length) {
            winnerName.textContent = "Nog geen score";
            winnerWattage.textContent = "0 W";
            list.innerHTML = '<div class="empty-state">Wachten op eerste poging...</div>';
            return;
        }

        winnerName.textContent = scores[0].name;
        winnerWattage.textContent = scores[0].wattage + " W";

        // Belangrijk: verwijder enkel de oude empty-state
        const emptyState = list.querySelector(".empty-state");
        if (emptyState) {
            emptyState.remove();
        }

        scores.forEach((score, index) => {
            let row = list.querySelector(`[data-score-id="${score.id}"]`);

            if (!row) {
                row = document.createElement("div");
                row.className = "score-row";
                row.setAttribute("data-score-id", score.id);

                row.innerHTML = `
                    <div class="rank"></div>
                    <div class="name"></div>
                    <div class="wattage"></div>
                `;

                list.appendChild(row);
            }

            row.className = "score-row";

            if (index === 0) row.classList.add("first");
            if (index === 1) row.classList.add("second");
            if (index === 2) row.classList.add("third");

            row.querySelector(".rank").textContent = "#" + (index + 1);
            row.querySelector(".name").textContent = score.name;
            row.querySelector(".wattage").textContent = score.wattage + " W";
        });

        // Sorteer visueel opnieuw volgens ranking
        scores.forEach(score => {
            const row = list.querySelector(`[data-score-id="${score.id}"]`);
            if (row) {
                list.appendChild(row);
            }
        });

        // Verwijder rijen die niet meer in top 5 zitten
        const rows = list.querySelectorAll(".score-row");

        rows.forEach(row => {
            const id = row.getAttribute("data-score-id");
            const stillInTopFive = scores.some(score => String(score.id) === String(id));

            if (!stillInTopFive) {
                row.remove();
            }
        });
    }

    loadScores();
    setInterval(loadScores, 2000);
</script>

</body>
</html>