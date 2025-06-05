class Event {
  final String title;
  final String category;
  //tableau de 1 ou 2 dates en fonction de si c'est une plage horaire ou une date précise
  final List<DateTime> dates;

  Event({
    required this.title,
    required this.category,
    required this.dates});
}
