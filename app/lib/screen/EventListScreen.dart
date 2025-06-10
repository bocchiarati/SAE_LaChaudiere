import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../providers/event_provider.dart';
import '../widget/event_search_bar.dart';
import '../widget/event_list.dart';
import 'EventDetailScreen.dart';

class EventListScreen extends StatelessWidget {
  const EventListScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final eventProvider = Provider.of<EventProvider>(context);

    return Scaffold(
      appBar: AppBar(
        title: const Text('Liste des Événements'),
      ),
      body: Column(
        children: [
          EventSearchBar(
            onSearch: (value) {
              eventProvider.setSearchQuery(value);
            },
          ),
          Padding(
            padding: const EdgeInsets.all(8.0),
            child: DropdownButton<int>(
              value: eventProvider.selectedCategoryId,
              hint: const Text("Choisir une catégorie"),
              onChanged: (int? newValue) {
                eventProvider.setSelectedCategoryId(newValue);
              },
              items: [
                const DropdownMenuItem<int>(
                  value: null,
                  child: Text('Toutes les catégories'),
                ),
                ...eventProvider.events.map((event) => event.categoryId).toSet().map<DropdownMenuItem<int>>((int category) {
                  return DropdownMenuItem<int>(
                    value: category,
                    child: Text('Catégorie $category'),
                  );
                }).toList(),
              ],
            ),
          ),
          Expanded(
            child: EventList(
              events: eventProvider.filteredEvents,
              onEventTap: (event) {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => EventDetailScreen(event: event),
                  ),
                );
              },
            ),
          ),
        ],
      ),
    );
  }
}
