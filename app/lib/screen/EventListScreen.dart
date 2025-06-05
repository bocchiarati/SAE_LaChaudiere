import 'package:flutter/material.dart';

import '../modele/event.dart';

class EventListScreen extends StatelessWidget {
  final List<Event> events = fetchAndSortEvents();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Liste des Événements'),
      ),
      body: ListView.builder(
        itemCount: events.length,
        itemBuilder: (context, index) {
          final event = events[index];
          return Card(
            child: ListTile(
              title: Text(event.title),
              subtitle: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text('Catégorie: ${event.category}'),
                  Text('Dates: ${event.dates.map((date) => "${date.day}/${date.month}/${date.year}").join(", ")}'),
                ],
              ),
            ),
          );
        },
      ),
    );
  }
}
