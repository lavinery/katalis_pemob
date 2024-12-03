import 'package:flutter/material.dart';

class AppTheme {
  static ThemeData get lightTheme {
    return ThemeData(
      scaffoldBackgroundColor: Colors.white,
      elevatedButtonTheme: ElevatedButtonThemeData(
        style: ElevatedButton.styleFrom(
          backgroundColor: Colors.blue[800],
          foregroundColor:
              Colors.white, // Ganti onPrimary dengan foregroundColor
        ),
      ),
      textTheme: TextTheme(
        displayLarge: TextStyle(
          color: Colors.blue[800],
          fontWeight: FontWeight.bold,
          fontSize: 24, // Tambahkan ukuran font
        ),
        bodyMedium: TextStyle(
          color: Colors.blue[600],
          fontSize: 16, // Tambahkan ukuran font
        ),
      ),
    );
  }
}
