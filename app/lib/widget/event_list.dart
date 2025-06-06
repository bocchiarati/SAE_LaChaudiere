// event_list.dart
import 'package:flutter/material.dart';
import '../modele/event.dart';

class EventList extends StatelessWidget {
  final List<Event> events;
  final Function(Event) onEventTap;

  const EventList({super.key, required this.events, required this.onEventTap});

  @override
  Widget build(BuildContext context) {
    return ListView.builder(
      itemCount: events.length,
      itemBuilder: (context, index) {
        final event = events[index];
        bool isSameDay = event.startDate.day == event.endDate.day &&
            event.startDate.month == event.endDate.month &&
            event.startDate.year == event.endDate.year;

        return Card(
          child: ListTile(
            title: Text(event.title),
            subtitle: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text('Description: ${event.description}'),
                if (isSameDay)
                  Text('Date: ${event.startDate.day}/${event.startDate.month}/${event.startDate.year}')
                else ...[
                  Text('Date de début: ${event.startDate.day}/${event.startDate.month}/${event.startDate.year}'),
                  Text('Date de fin: ${event.endDate.day}/${event.endDate.month}/${event.endDate.year}'),
                ],
              ],
            ),
            onTap: () => onEventTap(event),
          ),
        );
      },
    );
  }
}
