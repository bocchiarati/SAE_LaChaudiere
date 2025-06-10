
import 'package:flutter/foundation.dart';
import '../modele/event.dart';
import '../service/event_service.dart';

class EventProvider with ChangeNotifier {
  final EventService eventService = EventService();
  List<Event> _events = [];
  String _searchQuery = '';
  int? _selectedCategoryId;

  List<Event> get events => _events;
  String get searchQuery => _searchQuery;
  int? get selectedCategoryId => _selectedCategoryId;

  Future<void> fetchEvents() async {
    _events = await eventService.fetchEvents();
    notifyListeners();
  }

  void setSearchQuery(String query) {
    _searchQuery = query;
    notifyListeners();
  }

  void setSelectedCategoryId(int? categoryId) {
    _selectedCategoryId = categoryId;
    notifyListeners();
  }

  List<Event> get filteredEvents {
    return _events.where((event) {
      final matchesSearch = event.title.toLowerCase().contains(_searchQuery.toLowerCase());
      final matchesCategory = _selectedCategoryId == null || event.categoryId == _selectedCategoryId;
      return matchesSearch && matchesCategory;
    }).toList()..sort((a, b) => a.title.compareTo(b.title));
  }
}
