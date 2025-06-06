import 'dart:convert';
import 'package:http/http.dart' as http;
import '../modele/event.dart';

class EventService {
  static const String url = 'http://localhost:3000/api/events';

  Future<List<Event>> fetchEvents() async {
    final response = await http.get(Uri.parse(url));

    if (response.statusCode == 200) {
      final List<dynamic> data = json.decode(response.body);
      List<Event> events = [];

      for (var category in data[0]['categories']) {
        for (var eventData in category['evenements']) {
          events.add(Event.fromJson(eventData));
        }
      }

      return events;
    } else {
      throw Exception('Failed to load events');
    }
  }
}
