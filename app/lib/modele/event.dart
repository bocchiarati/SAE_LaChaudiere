import 'event_image.dart';


class Event {
  final int id;
  final String title;
  final String description;
  final DateTime startDate;
  final DateTime endDate;
  final String url;
  final String price;
  final String time;
  final int categoryId;
  final bool isPublished;
  final String userId;
  final List<Image> images; // Ajout du champ images

  Event({
    required this.id,
    required this.title,
    required this.description,
    required this.startDate,
    required this.endDate,
    required this.url,
    this.price = 'Prix non renseigné',
    this.time = '',
    this.categoryId = 0,
    this.isPublished = false,
    this.userId = 'Utilisateur inconnu',
    this.images = const [], // Initialisation par défaut
  });

  static DateTime parseDateTime(String dateStr) {
    return DateTime.parse(dateStr.replaceAll(' ', 'T'));
  }

  static Event fromJson(Map<String, dynamic> json) {
    // Parse images
    List<Image> images = [];
    if (json['images'] != null) {
      images = (json['images'] as List).map((imageJson) => Image.fromJson(imageJson)).toList();
    }

    return Event(
      id: json['id'] ?? 0,
      title: json['title'] ?? 'Aucun titre',
      description: json['description'] ?? 'Aucune description',
      startDate: parseDateTime(json['start_date'] ?? DateTime.now().toString()),
      endDate: parseDateTime(json['end_date'] ?? DateTime.now().toString()),
      url: json['url']?.toString() ?? '',
      price: json['price']?.toString() ?? 'Prix non renseigné',
      time: json['time']?.toString() ?? '',
      categoryId: json['category_id'] ?? 0,
      isPublished: json['is_published'] == 1,
      userId: json['user_id']?.toString() ?? 'Utilisateur inconnu',
      images: images, // Ajout des images
    );
  }
}