<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Watt Battle - Score invoeren</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="input-page">

    <main class="input-wrapper">
        <section class="input-card">
            <img src="assets/Aerts2015CMYK-blackletters.svg" alt="Aerts Action Bike" class="input-logo">

            <div class="brand-label">Live challenge</div>
            <h1>Watt Battle</h1>
            <p class="subtitle">Vul de deelnemer, competitie en het hoogste wattage in.</p>

            <?php if (isset($_GET["success"])): ?>
                <div class="success-message">Score toegevoegd. Klaar voor de volgende poging.</div>
            <?php endif; ?>

            <form action="submit.php" method="POST" class="score-form">
                <label for="competition">Competitie</label>
                <select id="competition" name="competition" required>
                    <option value="men">Mannen competitie</option>
                    <option value="women">Vrouwen competitie</option>
                    <option value="kids">Kinderen competitie</option>
                </select>

                <label for="name">Naam deelnemer</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="Bijv. Warre" 
                    maxlength="100"
                    required
                >

                <label for="wattage">Wattage</label>
                <input 
                    type="number" 
                    id="wattage" 
                    name="wattage" 
                    placeholder="Bijv. 875" 
                    min="1" 
                    max="3000"
                    required
                >

                <button type="submit">Score toevoegen</button>
            </form>

            <a href="dashboard.php" class="dashboard-link" target="_blank">
                Open dashboard
            </a>
        </section>
    </main>

</body>
</html>
