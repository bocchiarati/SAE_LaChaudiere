import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:todo_liste/providers/event_provider.dart';
import 'package:todo_liste/screen/EventListScreen.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (context) => EventProvider()..fetchEvents(),
      child: MaterialApp(
        title: 'La Chaudière',
        theme: ThemeData(
          colorScheme: ColorScheme.fromSeed(seedColor: Colors.deepPurple),
        ),
        home: const EventListScreen(),
      ),
    );
  }
}
