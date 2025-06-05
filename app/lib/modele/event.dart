class Event {
  final String title;
  final String category;
  final List<DateTime> dates;

  Event({required this.title, required this.category, required this.dates});

  factory Event.fromJson(Map<String, dynamic> json) {
    return Event(
      title: json['title'],
      category: json['category'],
      dates: (json['dates'] as List).map((date) => DateTime.parse(date)).toList(),
    );
  }
}
