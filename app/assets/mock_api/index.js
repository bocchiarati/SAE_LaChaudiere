const express = require('express');
const cors = require('cors');
const app = express();
const PORT = 3000;

app.use(cors());

const events = [
    {
        "type": "resource",
        "categories": [
            {
                "id": 1,
                "label": "Concert",
                "description": "Ã‰vÃ©nements musicaux en direct, tous styles confondus",
                "evenements": [
                    {
                        "id": 1,
                        "title": "Concert de jazz",
                        "description": "SoirÃ©e musicale avec des artistes locaux.",
                        "price": "15.00",
                        "start_date": "2025-07-10 20:00:00",
                        "end_date": "2025-07-10 22:00:00",
                        "time": "20:00:00",
                        "category_id": 1,
                        "is_published": 0,
                        "user_id": "a1b2c3d4-e5f6-7890-1234-56789abcdef0"
                    }
                ]
            },
            {
                "id": 2,
                "label": "ConfÃ©rence",
                "description": "PrÃ©sentations ou discussions sur des sujets professionnels ou acadÃ©miques",
                "evenements": [
                    {
                        "id": 5,
                        "title": "ConfÃ©rence tech",
                        "description": "PrÃ©sentation sur les derniÃ¨res innovations en intelligence artificielle.",
                        "price": "40.00",
                        "start_date": "2025-07-22 09:00:00",
                        "end_date": "2025-07-22 11:00:00",
                        "time": "09:00:00",
                        "category_id": 2,
                        "is_published": 0,
                        "user_id": "e5f6a1b2-c3d4-1234-5678-9abcdef01234"
                    }
                ]
            },
            {
                "id": 3,
                "label": "Atelier",
                "description": "Sessions pratiques pour apprendre ou crÃ©er",
                "evenements": [
                    {
                        "id": 3,
                        "title": "Atelier cuisine",
                        "description": "Apprenez Ã  cuisiner des plats du monde entier.",
                        "price": "25.50",
                        "start_date": "2025-07-15 14:30:00",
                        "end_date": "2025-07-15 17:30:00",
                        "time": "14:30:00",
                        "category_id": 3,
                        "is_published": 0,
                        "user_id": "c3d4e5f6-a1b2-9012-3456-789abcdef012"
                    }
                ]
            },
            {
                "id": 4,
                "label": "Exposition",
                "description": "Ã‰vÃ©nements dâ€™art ou de prÃ©sentation de travaux",
                "evenements": [
                    {
                        "id": 2,
                        "title": "Exposition photo",
                        "description": "DÃ©couvrez les Å“uvres de photographes contemporains.",
                        "price": "0.00",
                        "start_date": "2025-07-12 10:00:00",
                        "end_date": "2025-07-20 18:00:00",
                        "time": "10:00:00",
                        "category_id": 4,
                        "is_published": 0,
                        "user_id": "b2c3d4e5-f6a1-8901-2345-6789abcdef01"
                    }
                ]
            },
            {
                "id": 5,
                "label": "Festival",
                "description": "Ã‰vÃ©nements festifs sur plusieurs jours regroupant plusieurs activitÃ©s",
                "evenements": []
            },
            {
                "id": 6,
                "label": "Sport",
                "description": "CompÃ©titions ou dÃ©monstrations sportives",
                "evenements": []
            },
            {
                "id": 7,
                "label": "ThÃ©Ã¢tre",
                "description": "ReprÃ©sentations de piÃ¨ces et spectacles vivants",
                "evenements": [
                    {
                        "id": 4,
                        "title": "ThÃ©Ã¢tre de rue",
                        "description": "Spectacle gratuit dans le centre-ville.",
                        "price": "0.00",
                        "start_date": "2025-07-18 18:00:00",
                        "end_date": "2025-07-18 20:00:00",
                        "time": "18:00:00",
                        "category_id": 7,
                        "is_published": 0,
                        "user_id": "d4e5f6a1-b2c3-0123-4567-89abcdef0123"
                    }
                ]
            },
            {
                "id": 8,
                "label": "CinÃ©ma",
                "description": "Projections de films ou courts-mÃ©trages",
                "evenements": []
            },
            {
                "id": 9,
                "label": "Networking",
                "description": "Rencontres professionnelles ou communautaires",
                "evenements": []
            },
            {
                "id": 10,
                "label": "Jeux",
                "description": "Ã‰vÃ©nements autour du jeu : jeux de sociÃ©tÃ©, jeux vidÃ©o, escape game",
                "evenements": []
            }
        ]
    }
    ]

app.get('/api/events', (req, res) => {
res.json(events);
});

app.listen(PORT, () => {
console.log(`API mock disponible sur http://localhost:${PORT}/api/events`);
});
