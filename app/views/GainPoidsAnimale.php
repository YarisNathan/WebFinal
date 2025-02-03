<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcul du Gain de Poids</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            envoyerFormulaire();
        });

        function envoyerFormulaire() {
            let animalId = document.getElementById("animal_id").value;
            let date = document.getElementById("date").value;

            if (!animalId || !date) {
                alert("Veuillez sélectionner un animal et une date.");
                return;
            }

            fetch(`<?= Flight::get("flight.base_url") ?>/Animals/gainPoids/${animalId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        date: date
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("resultat").textContent = "Gain de poids estimé : " + data.gain_poids + " kg";
                })
                .catch(error => console.error("Erreur:", error));
        }
    </script>
</head>

<body>
    <h1>Calcul du Gain de Poids pour un Animal</h1>
    <form onsubmit="event.preventDefault(); envoyerFormulaire();">
        <label for="animal_id">Sélectionnez un animal:</label>
        <select id="animal_id" required>
            <?php foreach ($Animals as $Animal): ?>
                <option value="<?= htmlspecialchars($Animal['id']) ?>">
                    <?= htmlspecialchars($Animal['type_nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <br><br>

        <label for="date">Date (format YYYY-MM-DD):</label>
        <input type="date" id="date" required>

        <br><br>

        <button type="submit">Calculer le gain de poids</button>
    </form>

    <h2>Résultat:</h2>
    <p id="resultat"></p>
</body>

</html>
