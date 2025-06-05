const express = require('express');
const cors = require('cors');
const app = express();
const PORT = 3000;

app.use(cors());

const events = [
{
title: "Conférence IA",
category: "Technologie",
dates: ["2025-06-10T14:00:00Z"]
},
{
title: "Atelier peinture",
category: "Art",
dates: ["2025-06-12T10:00:00Z", "2025-06-12T12:00:00Z"]
},
{
title: "Tournoi e-sport",
category: "Jeux vidéo",
dates: ["2025-06-15T18:00:00Z"]
},
{
title: "Concert jazz",
category: "Musique",
dates: ["2025-06-20T20:00:00Z"]
},
{
title: "Exposition photo",
category: "Art",
dates: ["2025-06-18T09:00:00Z", "2025-06-25T17:00:00Z"]
},
{
title: "Startup Week-end",
category: "Business",
dates: ["2025-06-21T09:00:00Z", "2025-06-23T18:00:00Z"]
},
{
title: "Cours de yoga",
category: "Bien-être",
dates: ["2025-06-11T08:00:00Z"]
},
{
title: "Fête de la musique",
category: "Culture",
dates: ["2025-06-21T19:00:00Z"]
},
{
title: "Marathon de Nancy",
category: "Sport",
dates: ["2025-06-29T07:00:00Z"]
},
{
title: "Salon du livre",
category: "Littérature",
dates: ["2025-06-26T10:00:00Z", "2025-06-27T18:00:00Z"]
}
];

app.get('/api/events', (req, res) => {
res.json(events);
});

app.listen(PORT, () => {
console.log(`API mock disponible sur http://localhost:${PORT}/api/events`);
});
