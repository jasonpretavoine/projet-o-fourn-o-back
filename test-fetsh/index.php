<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <button>Charger les données</button>

  <script>
    document.querySelector('button').addEventListener('click', function() {
      fetch('https://localhost/projet/projet-o-fourn-o-back/public/api/recipes/view') // modifier par votre endpoint
        .then(response => response.json())
        .then(data => {
          console.log(data);
        });
    });
  </script>
</body>
</html>