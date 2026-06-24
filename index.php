<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Watt Battle - Score invoeren</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/form.css">
</head>
<body class="input-page">

    <main class="input-wrapper">
        <section class="input-card">
            <img src="assets/Aerts2015CMYK-blackletters.svg" alt="Aerts Action Bike" class="input-logo">

            <div class="brand-label">Live challenge</div>
            <h1>Watt Battle</h1>
            <p class="subtitle">Vul de deelnemer, e-mail, competitie en het hoogste wattage in.</p>

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

                <label for="email">E-mailadres</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Bijv. naam@email.be" 
                    maxlength="150"
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

                <label class="checkbox-row" for="newsletter_optin">
                    <input 
                        type="checkbox" 
                        id="newsletter_optin" 
                        name="newsletter_optin" 
                        value="1"
                    >
                    <span>Ja, ik wil nieuws, acties en updates van Aerts Action Bike ontvangen.</span>
                </label>

                <p class="privacy-note">
                    Je e-mailadres wordt gebruikt om je deelname te koppelen aan je score. Nieuwsbrieven sturen we enkel wanneer je dit hierboven aanvinkt.
                </p>

                <button type="submit">Score toevoegen</button>
            </form>

            <a href="dashboard.php" class="dashboard-link" target="_blank">
                Open dashboard
            </a>
        </section>
    </main>

</body>
</html>
