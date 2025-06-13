import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:todo_liste/providers/event_provider.dart';
import 'package:todo_liste/providers/theme_provider.dart';
import 'package:todo_liste/screen/EventListScreen.dart';

void main() {
  runApp(const MyApp());
}

final ThemeData lightTheme = ThemeData.from(
  colorScheme: ColorScheme.fromSeed(
    seedColor: Colors.redAccent,
    brightness: Brightness.light,
  ),
);

final ThemeData darkTheme = ThemeData.from(
  colorScheme: ColorScheme.fromSeed(
    seedColor: Colors.redAccent,
    brightness: Brightness.dark,
  ),
);

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (context) => EventProvider()),
        ChangeNotifierProvider(create: (context) => ThemeProvider()),
      ],
      child: Consumer<ThemeProvider>(
        builder: (context, themeProvider, child) {
          return MaterialApp(
            title: 'La Chaudière',
            theme: lightTheme,
            darkTheme: darkTheme,
            themeMode: themeProvider.themeMode,
            home: const EventListScreen(),
          );
        },
      ),
    );
  }
}
