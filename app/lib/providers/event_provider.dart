import 'package:flutter/foundation.dart';
import '../modele/event.dart';
import '../service/event_service.dart';

class EventProvider with ChangeNotifier {
  final EventService eventService = EventService();
  List<Event> _events = [];
  List<dynamic> _categories = [];
  String _searchQuery = '';
  int? _selectedCategoryId;
  DateTime? _startDate;
  DateTime? _endDate;
  bool _isLoading = false;

  List<Event> get events => _events;
  List<dynamic> get categories => _categories;
  String get searchQuery => _searchQuery;
  int? get selectedCategoryId => _selectedCategoryId;
  DateTime? get startDate => _startDate;
  DateTime? get endDate => _endDate;
  bool get isLoading => _isLoading;

  Future<void> fetchAndSetEvents() async {
    if (_isLoading) return;

    _isLoading = true;
    notifyListeners();

    try {
      _events = await eventService.fetchEvents();
      _categories = await eventService.fetchCategories();
    } catch (e) {
      print('Error fetching events or categories: $e');
      if (e is FormatException) {
        print('Response: ${e.message}');
      }
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  void setSearchQuery(String query) {
    _searchQuery = query;
    notifyListeners();
  }

  void setSelectedCategoryId(int? categoryId) {
    _selectedCategoryId = categoryId;
    notifyListeners();
  }

  void setStartDate(DateTime? date) {
    _startDate = date;
    notifyListeners();
  }

  void setEndDate(DateTime? date) {
    _endDate = date;
    notifyListeners();
  }

  List<Event> get filteredEvents {
    List<Event> filteredList = _events.where((event) {
      final matchesSearch = event.title.toLowerCase().contains(_searchQuery.toLowerCase());
      return matchesSearch;
    }).toList();

    if (_selectedCategoryId != null) {
      filteredList = filteredList.where((event) {
        return event.categoryId == _selectedCategoryId;
      }).toList();
    }

    if (_startDate != null) {
      filteredList = filteredList.where((event) {
        return event.startDate.isAfter(_startDate!) || event.startDate.isAtSameMomentAs(_startDate!);
      }).toList();
    }

    if (_endDate != null) {
      filteredList = filteredList.where((event) {
        return event.endDate.isBefore(_endDate!) || event.endDate.isAtSameMomentAs(_endDate!);
      }).toList();
    }

    filteredList.sort((a, b) => a.title.compareTo(b.title));
    return filteredList;
  }
}


