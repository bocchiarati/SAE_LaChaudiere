import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:provider/provider.dart';
import '../providers/event_provider.dart';
import '../widget/event_search_bar.dart';
import '../widget/event_list.dart';
import 'EventDetailScreen.dart';

class EventListScreen extends StatefulWidget {
  const EventListScreen({super.key});

  @override
  State<EventListScreen> createState() => _EventListScreenState();
}

class _EventListScreenState extends State<EventListScreen> {
  DateTime? _startDate;
  DateTime? _endDate;

  Future<void> _selectStartDate(BuildContext context) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(2000),
      lastDate: DateTime(2100),
    );
    if (picked != null && picked != _startDate) {
      setState(() {
        _startDate = picked;
      });
      Provider.of<EventProvider>(context, listen: false).setStartDate(picked);
    }
  }

  Future<void> _selectEndDate(BuildContext context) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(2000),
      lastDate: DateTime(2100),
    );
    if (picked != null && picked != _endDate) {
      setState(() {
        _endDate = picked;
      });
      Provider.of<EventProvider>(context, listen: false).setEndDate(picked);
    }
  }

  @override
  Widget build(BuildContext context) {
    final eventProvider = Provider.of<EventProvider>(context);

    if (!eventProvider.isLoading && eventProvider.events.isEmpty) {
      WidgetsBinding.instance.addPostFrameCallback((_) {
        eventProvider.fetchAndSetEvents();
      });
    }

    return Scaffold(
      appBar: AppBar(
        title: const Text('Liste des Événements'),
      ),
      body: Column(
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
            children: [
              ElevatedButton(
                onPressed: () => _selectStartDate(context),
                child: Text(_startDate == null ? 'Date de début' : DateFormat('dd/MM/yyyy').format(_startDate!)),
              ),
              ElevatedButton(
                onPressed: () => _selectEndDate(context),
                child: Text(_endDate == null ? 'Date de fin' : DateFormat('dd/MM/yyyy').format(_endDate!)),
              ),
            ],
          ),
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
                ...eventProvider.categories.map<DropdownMenuItem<int>>((category) {
                  return DropdownMenuItem<int>(
                    value: category['id'],
                    child: Text(category['label']),
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
                    builder: (context) => EventDetailScreen(eventId: event.id),
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





