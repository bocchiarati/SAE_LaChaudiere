import 'package:flutter/material.dart';
import '../modele/event.dart';
import '../service/event_service.dart';

class EventDetailScreen extends StatefulWidget {
  final int eventId;

  const EventDetailScreen({super.key, required this.eventId});

  @override
  State<EventDetailScreen> createState() => _EventDetailScreenState();
}

class _EventDetailScreenState extends State<EventDetailScreen> {
  late Future<Event> futureEvent;
  final EventService eventService = EventService();

  @override
  void initState() {
    super.initState();
    futureEvent = eventService.fetchEventDetail(widget.eventId);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Détails de l\'événement'),
        backgroundColor: Colors.redAccent,
      ),
      body: FutureBuilder<Event>(
        future: futureEvent,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Erreur: ${snapshot.error}'));
          } else if (snapshot.hasData) {
            return EventDetailContent(event: snapshot.data!);
          } else {
            return const Center(child: Text('Aucune donnée disponible'));
          }
        },
      ),
    );
  }
}

class EventDetailContent extends StatelessWidget {
  final Event event;

  const EventDetailContent({super.key, required this.event});

  @override
  Widget build(BuildContext context) {
    bool isSameDay = _isSameDay(event.startDate, event.endDate);

    return SingleChildScrollView(
      child: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            if (event.images.isNotEmpty)
              Column(
                children: event.images.map((image) {
                  return Image.network(
                    '${EventService.baseUrl}${image.url}',
                    fit: BoxFit.cover,
                    height: 200,
                    width: double.infinity,
                  );
                }).toList(),
              ),
            EventCard(event: event, isSameDay: isSameDay),
          ],
        ),
      ),
    );
  }

  bool _isSameDay(DateTime startDate, DateTime endDate) {
    return startDate.day == endDate.day &&
        startDate.month == endDate.month &&
        startDate.year == endDate.year;
  }
}

class EventCard extends StatelessWidget {
  final Event event;
  final bool isSameDay;

  const EventCard({super.key, required this.event, required this.isSameDay});

  @override
  Widget build(BuildContext context) {
    return Card(
      elevation: 4,
      child: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              event.title,
              style: const TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 16),
            Text(
              event.description,
              style: const TextStyle(fontSize: 16),
            ),
            const SizedBox(height: 16),
            _buildInfoRow(Icons.euro, Colors.green, 'Prix: ${event.price}'),
            _buildDateInfo(),
            _buildInfoRow(Icons.access_time, Colors.orange, 'Heure: ${event.time}'),
            _buildInfoRow(Icons.category, Colors.purple, 'Catégorie: ${event.categoryId}'),
            _buildInfoRow(Icons.publish, Colors.blueGrey, 'Publié: ${event.isPublished ? "Oui" : "Non"}'),
          ],
        ),
      ),
    );
  }

  Widget _buildInfoRow(IconData icon, Color color, String text) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 4.0),
      child: Row(
        children: [
          Icon(icon, color: color),
          const SizedBox(width: 8),
          Text(
            text,
            style: const TextStyle(fontSize: 16),
          ),
        ],
      ),
    );
  }

  Widget _buildDateInfo() {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 4.0),
      child: Row(
        children: [
          const Icon(Icons.calendar_today, color: Colors.blue),
          const SizedBox(width: 8),
          isSameDay
              ? Text(
            'Date: ${_formatDate(event.startDate)}',
            style: const TextStyle(fontSize: 16),
          )
              : Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                'Date de début: ${_formatDate(event.startDate)}',
                style: const TextStyle(fontSize: 16),
              ),
              Text(
                'Date de fin: ${_formatDate(event.endDate)}',
                style: const TextStyle(fontSize: 16),
              ),
            ],
          ),
        ],
      ),
    );
  }

  String _formatDate(DateTime date) {
    return '${date.day}/${date.month}/${date.year}';
  }
}
