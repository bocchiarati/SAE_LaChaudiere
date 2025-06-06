// event_list.dart
import 'package:flutter/material.dart';
import '../modele/event.dart';

class EventList extends StatelessWidget {
  final List<Event> events;

  const EventList({super.key, required this.events});

  @override
  Widget build(BuildContext context) {
    return ListView.builder(
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
    );
  }
}
