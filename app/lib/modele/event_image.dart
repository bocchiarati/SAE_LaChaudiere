class Image {
  final int id;
  final int eventId;
  final String url;

  Image({
    required this.id,
    required this.eventId,
    required this.url,
  });

  factory Image.fromJson(Map<String, dynamic> json) {
    return Image(
      id: json['id'],
      eventId: json['event_id'],
      url: json['url'],
    );
  }
}