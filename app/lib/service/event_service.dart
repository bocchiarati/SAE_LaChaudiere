import 'dart:convert';
import 'package:http/http.dart' as http;
import '../modele/event.dart';

class EventService {
  static const String baseUrl = 'http://docketu.iutnc.univ-lorraine.fr:41257';

  Future<List<Event>> fetchEvents() async {
    final response = await http.get(
      Uri.parse('$baseUrl/api/events'),
      headers: {'Accept': 'application/json'},
    );

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      if (data is Map && data.containsKey('events')) {
        List<Event> events = [];
        for (var json in data['events']) {
          // Récupérez les détails complets de chaque événement
          Event event = await fetchEventDetail(json['id']);
          events.add(event);
        }
        return events;
      }
      throw Exception('Format de données inattendu pour les événements');
    } else {
      throw Exception('Échec du chargement des événements: ${response.statusCode}');
    }
  }

  Future<Event> fetchEventDetail(int eventId) async {
    final response = await http.get(
      Uri.parse('$baseUrl/api/event/$eventId'),
      headers: {'Accept': 'application/json'},
    );

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      if (data is Map && data.containsKey('event')) {
        return Event.fromJson(data['event']);
      }
      throw Exception('Format de données inattendu pour les détails de l\'événement');
    } else {
      throw Exception('Échec du chargement des détails de l\'événement: ${response.statusCode}');
    }
  }

  Future<List<dynamic>> fetchCategories() async {
    final response = await http.get(
      Uri.parse('$baseUrl/api/categories'),
      headers: {'Accept': 'application/json'},
    );

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      if (data is Map && data.containsKey('categories')) {
        return data['categories'];
      }
      throw Exception('Format de données inattendu pour les catégories');
    } else {
      throw Exception('Échec du chargement des catégories: ${response.statusCode}');
    }
  }
}


