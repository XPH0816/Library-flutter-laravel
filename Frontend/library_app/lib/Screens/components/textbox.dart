import 'package:flutter/material.dart';

class TextBox extends StatelessWidget {
  final List<String> strArr;

  const TextBox({
    Key? key,
    required this.strArr,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Column(
      children: <Widget>[
        Container(
            padding: EdgeInsets.only(bottom: 2),
            child: Text(
              strArr[0],
              style: TextStyle(
                  fontWeight: FontWeight.w600,
                  fontSize: 16.0,
                  color: Colors.white.withOpacity(0.75)),
            )),
        Container(
          child: Text(
            strArr[1],
            style: TextStyle(
                fontWeight: FontWeight.w900,
                fontSize: 30.0,
                color: Colors.white),
          ),
        )
      ],
    );
  }
}
