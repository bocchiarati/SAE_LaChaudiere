class Event {
  final int id;
  final String title;
  final String description;
  final String price;
  final DateTime startDate;
  final DateTime endDate;
  final String time;
  final int categoryId;
  final bool isPublished;
  final String userId;

  Event({
    required this.id,
    required this.title,
    required this.description,
    required this.price,
    required this.startDate,
    required this.endDate,
    required this.time,
    required this.categoryId,
    required this.isPublished,
    required this.userId,
  });

  factory Event.fromJson(Map<String, dynamic> json) {
    return Event(
      id: json['id'],
      title: json['title'] ?? 'Aucun titre',
      description: json['description'] ?? 'Aucune description',
      price: json['price'] ?? 'Prix non renseigné',
      startDate: DateTime.parse(json['start_date']),
      endDate: DateTime.parse(json['end_date']),
      time: json['time'],
      categoryId: json['category_id'],
      isPublished: json['is_published'] == 1,
      userId: json['user_id'] ?? 'Unknown User',
    );
  }
}
