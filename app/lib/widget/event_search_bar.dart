// event_search_bar.dart
import 'package:flutter/material.dart';

class EventSearchBar extends StatelessWidget {
  final ValueChanged<String> onSearch;

  const EventSearchBar({super.key, required this.onSearch});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(8.0),
      child: TextField(
        decoration: const InputDecoration(
          labelText: 'Rechercher un événement',
          hintText: 'Entrez un titre',
          prefixIcon: Icon(Icons.search),
          border: OutlineInputBorder(),
        ),
        onChanged: onSearch,
      ),
    );
  }
}
