// event_list_screen.dart
import 'package:flutter/material.dart';
import '../service/event_service.dart';
import '../widget/event_search_bar.dart';
import '../widget/event_list.dart';
import '../modele/event.dart';
import 'EventDetailScreen.dart';

class EventListScreen extends StatefulWidget {
  const EventListScreen({super.key});

  @override
  _EventListScreenState createState() => _EventListScreenState();
}

class _EventListScreenState extends State<EventListScreen> {
  late Future<List<Event>> futureEvents;
  String searchQuery = '';
  final EventService eventService = EventService();

  @override
  void initState() {
    super.initState();
    futureEvents = eventService.fetchEvents();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Liste des Événements'),
      ),
      body: Column(
        children: [
          EventSearchBar(
            onSearch: (value) {
              setState(() {
                searchQuery = value;
              });
            },
          ),
          Expanded(
            child: FutureBuilder<List<Event>>(
              future: futureEvents,
              builder: (context, snapshot) {
                if (snapshot.connectionState == ConnectionState.waiting) {
                  return const Center(child: CircularProgressIndicator());
                } else if (snapshot.hasError) {
                  return Center(child: Text('Error: ${snapshot.error}'));
                } else {
                  final events = snapshot.data!;
                  final filteredEvents = events.where((event) {
                    return event.title.toLowerCase().contains(searchQuery.toLowerCase());
                  }).toList();

                  return EventList(
                    events: filteredEvents,
                    onEventTap: (event) {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (context) => EventDetailScreen(event: event),
                        ),
                      );
                    },
                  );
                }
              },
            ),
          ),
        ],
      ),
    );
  }
}
