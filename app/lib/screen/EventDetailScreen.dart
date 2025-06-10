// event_detail_screen.dart
import 'package:flutter/material.dart';
import '../modele/event.dart';

class EventDetailScreen extends StatelessWidget {
  final Event event;

  const EventDetailScreen({super.key, required this.event});

  @override
  Widget build(BuildContext context) {
    bool isSameDay = event.startDate == event.endDate;

    return Scaffold(
      appBar: AppBar(
        title: Text(event.title),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Description: ${event.description}'),
            const SizedBox(height: 8),
            Text('Prix: ${event.price}'),
            const SizedBox(height: 8),
            if (isSameDay)
              Text('Date: ${event.startDate.day}/${event.startDate.month}/${event.startDate.year}')
            else ...[
              Text('Date de début: ${event.startDate.day}/${event.startDate.month}/${event.startDate.year}'),
              Text('Date de fin: ${event.endDate.day}/${event.endDate.month}/${event.endDate.year}'),
            ],
            const SizedBox(height: 8),
            Text('Heure: ${event.time}'),
            const SizedBox(height: 8),
            Text('Catégorie ID: ${event.categoryId}'),
            const SizedBox(height: 8),
            Text('Publié: ${event.isPublished ? "Oui" : "Non"}'),
            const SizedBox(height: 8),
            Text('Utilisateur ID: ${event.userId}'),
          ],
        ),
      ),
    );
  }
}
