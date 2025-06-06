// event_service.dart
import 'package:http/http.dart' as http;
import 'dart:convert';
import '../modele/event.dart';

class EventService {
  Future<List<Event>> fetchEvents() async {
    final response = await http.get(Uri.parse('http://localhost:3000/api/events'));

    if (response.statusCode == 200) {
      List<dynamic> data = json.decode(response.body);
      List<Event> events = data.map((json) => Event.fromJson(json)).toList();
      events.sort((a, b) => a.title.compareTo(b.title));
      return events;
    } else {
      throw Exception('Failed to load events');
    }
  }
}
